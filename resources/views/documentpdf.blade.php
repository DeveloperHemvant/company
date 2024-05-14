<!DOCTYPE html>
<html>
<head>
    <title>Document PDF</title>
</head>
<body>
    @foreach ($documents as $document)
        <div style="page-break-after: always;">
            <img src="{{ $document }}" style="width: 100%;">
        </div>
    @endforeach
</body>
</html>
