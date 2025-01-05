<!DOCTYPE html>
<html>
<head>
    <title>Transcript</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .section {
            margin-bottom: 40px;
            page-break-after: always;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Transcript</h1>
        <p><strong>File Name:</strong> {{ $file_name }}</p>
        <p><strong>Date:</strong> {{ $created_at }}</p>
    </div>

    @foreach (array_chunk($transcripts, 10) as $chunk)
        <div class="section">
            @foreach ($chunk as $segment)
                <p><strong>{{ $segment['speaker'] ?? 'Unknown Speaker' }}:</strong> {{ $segment['text'] ?? '' }}</p>
            @endforeach
        </div>
    @endforeach
</body>
</html>
