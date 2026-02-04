<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>customer Dashboard - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-lg p-5">
        <h2 class="font-bold text-xl mb-5">User Panel</h2>

        <ul class="space-y-3">

            <li>
                <a href="{{ route('customer.dashboard') }}"
                   class="block p-2 rounded
                    {{ request()->routeIs('customer.dashboard') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700' }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href=""
                   class="block p-2 rounded
                    {{ request()->routeIs('user.profile') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700' }}">
                    Profile
                </a>
            </li>

            <li>
                <a href=""
                   class="block p-2 rounded
                    {{ request()->routeIs('user.orders') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700' }}">
                    My Orders
                </a>
            </li>

            <li>
                <a href=""
                   class="block p-2 rounded
                    {{ request()->routeIs('user.wishlist') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700' }}">
                    Wishlist
                </a>
            </li>

            <li>
                <a href=""
                   class="block p-2 rounded
                    {{ request()->routeIs('user.reviews') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700' }}">
                    My Reviews
                </a>
            </li>

            <li>
                <a href=""
                   class="block p-2 rounded
                    {{ request()->routeIs('user.address') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700' }}">
                    Address Book
                </a>
            </li>

            <li>
                <a href=""
                   class="block p-2 rounded
                    {{ request()->routeIs('user.notifications') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700' }}">
                    Notifications
                </a>
            </li>

            <li class="pt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-start p-2 text-red-600 font-semibold hover:bg-red-100 rounded">
                        Logout
                    </button>
                </form>
            </li>

        </ul>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

@livewireScripts
</body>
</html>
