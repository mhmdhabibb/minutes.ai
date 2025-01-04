# transcription.py
import sys
import speech_recognition as sr
from pydub import AudioSegment

def main():
    if len(sys.argv) != 2:
        print("Usage: python transcription.py <audio_path>")
        sys.exit(1)

    audio_path = sys.argv[1]

    try:
        # Convert the audio file to WAV using pydub (in case it's not already in the correct format)
        audio = AudioSegment.from_file(audio_path)
        wav_audio_path = "converted_audio.wav"
        audio.export(wav_audio_path, format="wav")

        # Now use the SpeechRecognition library to transcribe the WAV file
        recognizer = sr.Recognizer()
        with sr.AudioFile(wav_audio_path) as source:
            audio = recognizer.record(source)
        transcription = recognizer.recognize_google(audio)
        print(transcription)  # Ensure it's printed correctly
    except Exception as e:
        print(f"Error in transcription: {e}", file=sys.stderr)
        sys.exit(1)

if __name__ == "__main__":
    main()
