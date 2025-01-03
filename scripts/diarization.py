from pyannote.audio import Pipeline
import sys
import os
from pydub import AudioSegment

def segment_audio(audio_path, chunk_duration_ms=300000):  # Default chunk is 5 minutes (300,000ms)
    """Segment audio into smaller parts to avoid memory issues."""
    try:
        # Handle .mp3 and convert it to .wav internally
        if audio_path.lower().endswith('.mp3'):
            audio = AudioSegment.from_mp3(audio_path)
        else:
            audio = AudioSegment.from_wav(audio_path)

        chunks = []
        
        # Split audio into chunks of specified duration
        for i in range(0, len(audio), chunk_duration_ms):
            chunk = audio[i:i + chunk_duration_ms]
            chunk_file = f"{audio_path}_chunk_{i}.wav"
            chunk.export(chunk_file, format="wav")
            chunks.append(chunk_file)
        
        return chunks

    except Exception as e:
        raise RuntimeError(f"Error during audio segmentation: {str(e)}")

def diarize_audio(audio_path):
    try:
        # Ensure the audio file exists
        if not os.path.exists(audio_path):
            raise FileNotFoundError(f"Audio file not found: {audio_path}")

        # Segment the audio if it is too long
        chunks = segment_audio(audio_path)
        output_files = []

        # Instantiate the pretrained speaker diarization pipeline
        pipeline = Pipeline.from_pretrained("pyannote/speaker-diarization@2.1", 
                                            use_auth_token="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")

        # Process each chunk
        for chunk in chunks:
            # Apply the pipeline to an audio chunk
            diarization = pipeline(chunk)

            # Set output file path for each chunk (ensure it's writable)
            output_file = f"{chunk}_audio.rttm"
            output_files.append(output_file)

            # Write the diarization output to an RTTM file
            with open(output_file, "w") as rttm:
                diarization.write_rttm(rttm)

        # Return the diarization result (returning paths of all RTTM files)
        return f"Diarization completed successfully for chunks. Results saved to: {', '.join(output_files)}"

    except Exception as e:
        return f"Error during diarization: {str(e)}"

# Call the function with the audio path
if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python diarization.py <audio_path>")
        sys.exit(1)

    audio_file_path = sys.argv[1]  # Get the audio file path from command line arguments
    diarization_result = diarize_audio(audio_file_path)
    print(diarization_result)
