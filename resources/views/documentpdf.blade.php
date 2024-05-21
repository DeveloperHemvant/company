<!DOCTYPE html>
<html>
<head>
    <title>Student Document's</title>
</head>
<body>
    @foreach ($documents as $index => $document)
        <div @if($index < count($documents) - 1)  @endif>
            <img src="{{ $document }}" style="width: 100%;">
        </div>
    @endforeach
</body>
</html>
