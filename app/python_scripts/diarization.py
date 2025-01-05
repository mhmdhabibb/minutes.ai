import sys
import json
import os
import whisper
from pyannote.audio import Pipeline
import torch.multiprocessing as mp

# Suppress all warnings and logs
import warnings
warnings.filterwarnings("ignore")
os.environ["PYTHONWARNINGS"] = "ignore"  # Suppress Python warnings

# Set multiprocessing start method for Windows compatibility
mp.set_start_method("spawn", force=True)

# Redirect stdout and stderr to ensure clean JSON output
class CleanOutput:
    def __init__(self):
        self.original_stdout = sys.stdout
        self.original_stderr = sys.stderr
        self.devnull = open(os.devnull, 'w')

    def __enter__(self):
        sys.stdout = self.devnull
        sys.stderr = self.devnull

    def __exit__(self, exc_type, exc_val, exc_tb):
        sys.stdout = self.original_stdout
        sys.stderr = self.original_stderr
        self.devnull.close()

def process_audio(audio_path, token):
    """
    Process the audio file using Whisper for transcription and Pyannote for diarization.

    Args:
        audio_path (str): Path to the audio file.
        token (str): Hugging Face API token.

    Returns:
        list: A list of diarized transcription results.
    """
    # Check if the audio file exists
    if not os.path.exists(audio_path):
        raise FileNotFoundError(f"Audio file not found: {audio_path}")

    # Load Whisper and Pyannote models
    try:
        whisper_model = whisper.load_model("small")
    except Exception as e:
        raise RuntimeError(f"Failed to load Whisper model: {str(e)}")

    try:
        pipeline = Pipeline.from_pretrained("pyannote/speaker-diarization", use_auth_token=token)
    except Exception as e:
        raise RuntimeError(f"Failed to load Pyannote pipeline: {str(e)}")

    # Transcription using Whisper
    try:
        result = whisper_model.transcribe(audio_path)
        segments = result.get("segments", [])
    except Exception as e:
        raise RuntimeError(f"Whisper transcription failed: {str(e)}")

    # Diarization using Pyannote
    try:
        diarization = pipeline(audio_path)
    except Exception as e:
        raise RuntimeError(f"Pyannote diarization failed: {str(e)}")

    # Combine results
    results = []
    for seg in segments:
        start_time, end_time, text = seg["start"], seg["end"], seg["text"]
        for turn, _, speaker in diarization.itertracks(yield_label=True):
            if turn.start <= start_time <= turn.end:
                results.append({
                    "speaker": speaker,
                    "start_time": f"{int(start_time // 60):02}:{int(start_time % 60):02}",
                    "end_time": f"{int(end_time // 60):02}:{int(end_time % 60):02}",
                    "text": text
                })
                break
    return results


if __name__ == "__main__":
    # Validate command-line arguments
    if len(sys.argv) != 3:
        print(json.dumps({
            "status": "error",
            "message": "Usage: python diarization.py <audio_path> <huggingface_token>"
        }))
        sys.exit(1)

    audio_path = sys.argv[1]
    huggingface_token = sys.argv[2]

    try:
        # Use clean output context to suppress logs
        with CleanOutput():
            output = process_audio(audio_path, huggingface_token)

        # Print only the JSON response
        print(json.dumps({"status": "success", "results": output}))

    except FileNotFoundError as e:
        print(json.dumps({"status": "error", "message": str(e)}))
    except RuntimeError as e:
        print(json.dumps({"status": "error", "message": str(e)}))
    except Exception as e:
        print(json.dumps({"status": "error", "message": f"Unexpected error: {str(e)}"}))
