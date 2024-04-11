<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow py-4 px-6 flex justify-between items-center">
        <button id="sidebarToggle"
            class="block lg:hidden text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900"
            aria-label="Toggle sidebar">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                </path>
            </svg>
        </button>
        <h2 class="text-lg font-semibold">@yield('title')</h2>
        <div class="flex items-center">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="text-gray-600 hover:text-gray-900">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex flex-1">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 flex-shrink-0 overflow-y-auto">
            <div class="p-4 flex flex-col h-screen justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white">Admin Panel</h1>
                    <nav class="mt-6">
                        <a href="{{ route('admin.dashboard') }}"
                            class="block py-2 px-4 rounded-lg text-gray-200 hover:bg-gray-700">Dashboard</a>
                        <a href="{{ route('admin.users.index') }}"
                            class="block py-2 px-4 rounded-lg text-gray-200 hover:bg-gray-700">Users</a>
                        <!-- Add more sidebar links as needed -->
                    </nav>
                </div>
                <div></div> <!-- Empty div to push content to bottom -->
            </div>
        </aside>

        <!-- Page Content -->
        <div class="p-6 flex-1">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4">
            <p class="text-sm text-center">&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript to toggle sidebar on smaller screens -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('aside');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
            });
        });
    </script>
</body>

</html>
