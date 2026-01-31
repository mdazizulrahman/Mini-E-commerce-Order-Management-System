<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen flex flex-col">
     <div class=" p-4 shadow rounded text-center">
    <div class="">Profile</div>
    <img src="https://via.placeholder.com/150"
         alt="Logo"
         class="mx-auto rounded-full object-cover">
</div>


            <div class="px-6 py-4 text-2xl font-bold border-b border-gray-700">
                Admin Panel
            </div>

            <nav class="flex-1 px-4 py-6 space-y-3">
                <a href="{{ route('admin.dashboard') }}"
                   class="block py-2 px-3 rounded-lg hover:bg-gray-700 {{ request()->is('admin/dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="block py-2 px-3 rounded-lg hover:bg-gray-700">
                    Users
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="block py-2 px-3 rounded-lg hover:bg-gray-700">
                    Products
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="block py-2 px-3 rounded-lg hover:bg-gray-700">
                    Orders
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full py-2 rounded-lg bg-red-600 hover:bg-red-700">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">

            <!-- Topbar -->
            <header class="flex justify-between items-center bg-white shadow px-6 py-4">
                <h1 class="text-xl font-semibold">@yield('page_title')</h1>

                <div class="flex items-center space-x-4">
                    <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                    <img class="w-10 h-10 rounded-full"
                         src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}"
                         alt="">
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>

        </main>

    </div>

    @livewireScripts
</body>
</html>
