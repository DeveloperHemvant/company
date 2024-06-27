<!DOCTYPE html>
<html>
<head>
    <title>Student Document's</title>
    <style>
        @media print {
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    {{-- @foreach ($documents as $index => $document)
        <div @if($index < count($documents) - 1) class="page-break" @endif>
            <img src="{{ $document }}" style="width: 100%;">
        </div>
    @endforeach --}}
    <img src="{{ $imagePath }}" alt="Image" style="width: 100%; height: auto;">
</body>
</html>

