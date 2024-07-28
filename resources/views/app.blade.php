<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARCHUB V2</title>

    @production
    @vite(['resources/scripts/main.ts'])
    @else
    <script type="module" src="http://localhost:5173/@@vite/client"></script>
    <script type="module" src="http://localhost:5173/resources/scripts/main.ts"></script>
    @endproduction

    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>
