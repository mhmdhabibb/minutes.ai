import sys
import json
from transformers import pipeline

def main():
    if len(sys.argv) != 2:
        print(json.dumps({"error": "Usage: python summary.py <transcription_text>"}))
        sys.exit(1)

    transcription_text = sys.argv[1]

    try:
        summarizer = pipeline("summarization", model="facebook/bart-large-cnn")
        summary = summarizer(
            transcription_text, 
            max_length=50, 
            min_length=25, 
            do_sample=False
        )[0]['summary_text']
        
        print(json.dumps({"summary": summary}))
    except Exception as e:
        print(json.dumps({"error": str(e)}), file=sys.stderr)
        sys.exit(1)

if __name__ == "__main__":
    main()
