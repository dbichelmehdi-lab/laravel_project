<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('complete.order') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">
            Complete Order (Skip Payment for Testing)
        </button>
    </form>
</body>

</html>