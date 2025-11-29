<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        @include('layouts.partials.header')
        <main class="min-h-screen container mx-auto py-6">
            @yield('content')
        </main>
        @include('layouts.partials.footer')
    </body>
</html>
