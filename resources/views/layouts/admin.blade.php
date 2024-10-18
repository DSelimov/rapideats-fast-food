<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Admin Panel</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="{{ route('admin.food-items.index') }}">Food Items</a></li>
        <!-- Add more admin links as needed -->
    </ul>
</nav>

<main>
    @yield('content')
</main>
</body>
</html>
