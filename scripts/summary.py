import sys
from transformers import pipeline  # Importing the pipeline from Hugging Face

def main():
    if len(sys.argv) != 2:
        print("Usage: python summary.py <transcription_text>")
        sys.exit(1)

    transcription_text = sys.argv[1]  # Corrected the variable name

    try:
        # Initialize the summarization pipeline with the model specified explicitly
        summarizer = pipeline("summarization", model="facebook/bart-large-cnn")  # Using a more common model
        summary = summarizer(transcription_text, max_length=70, min_length=30, do_sample=False)  # Get the summary of the transcription text
        print(summary[0]['summary_text'])  # Print the summarized text
    except Exception as e:
        print(f"Error in summarization: {e}", file=sys.stderr)
        sys.exit(1)

if __name__ == "__main__":
    main()
