<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.88em%22 font-size=%2282%22>🐯</text></svg>">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>@yield('title', 'Gimas Studio')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <style>
        html {
            scroll-behavior: smooth;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
        }

        .nav-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .menu-overlay {
            backdrop-filter: blur(4px);
        }

        .show-mobile-menu .nav-menu {
            transform: translateX(0);
        }

        .show-mobile-menu .menu-overlay {
            opacity: 1;
            pointer-events: auto;
        }

        .scroll-up-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: #1f1f1f;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
        }

        .scroll-up-btn:hover {
            background-color: #c5b49d;
            transform: translateY(-3px);
        }

        .scroll-up-btn.show {
            opacity: 1;
            visibility: visible;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50">

    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>

    {{-- Header --}}
    @include('layouts.partials.header')

    <!-- Important: Add padding for sticky header -->
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
