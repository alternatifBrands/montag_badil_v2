<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('import_via_scrapping') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="">
        <input type="submit" name="" id="">
    </form>
</body>
</html>