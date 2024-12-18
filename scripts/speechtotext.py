import sys
import whisper
from transformers import pipeline

if len(sys.argv) < 2:
    print("Error: No audio file path provided.")
    sys.exit(1)

audio_path = sys.argv[1]
try:
    # Load Whisper model
    model = whisper.load_model("base")
    result = model.transcribe(audio_path)
    transcription = result["text"]

    # Summarize transcription
    summarizer = pipeline("summarization", model="t5-small")
    summary = summarizer(transcription, max_length=70, min_length=30, do_sample=False)

    print("")
    print(transcription)
    print("\nSUMMARY:")
    print(summary[0]["summary_text"])

except Exception as e:
    print(f"Error processing file: {e}")
    sys.exit(1)