import sys
from transformers import pipeline

def main():
    if len(sys.argv) != 2:
        print("Usage: python summary.py <transcription_text>")
        sys.exit(1)

    transcription_text = sys.argv[1]
    print(f"{transcription_text[:100]}...")  # Debug log

    try:
        # Initialize the summarization pipeline
        summarizer = pipeline("summarization", model="facebook/bart-large-cnn")
        summary = summarizer(
            transcription_text, 
            max_length=50,  # Adjust max_length to enforce a shorter summary
            min_length=25, 
            do_sample=False
        )
        print(f"Summary: {summary[0]['summary_text']}")
    except Exception as e:
        print(f"Error in summarization: {e}", file=sys.stderr)
        sys.exit(1)

if __name__ == "__main__":
    main()
