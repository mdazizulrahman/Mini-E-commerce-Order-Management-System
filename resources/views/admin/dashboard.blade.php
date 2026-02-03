

@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Card 1 -->
    <div class="p-6 bg-white rounded-xl shadow-md border">
        <h2 class="text-xl font-semibold text-gray-700">Users</h2>
        <p class="text-4xl font-bold text-blue-600 mt-3">1,245</p>
    </div>

    <!-- Card 2 -->
    <div class="p-6 bg-white rounded-xl shadow-md border">
        <h2 class="text-xl font-semibold text-gray-700">Orders</h2>
        <p class="text-4xl font-bold text-green-600 mt-3">982</p>
    </div>

    <!-- Card 3 -->
    <div class="p-6 bg-white rounded-xl shadow-md border">
        <h2 class="text-xl font-semibold text-gray-700">Revenue</h2>
        <p class="text-4xl font-bold text-pink-600 mt-3">$12,540</p>
    </div>

</div>

<!-- Chart or Table Placeholder -->
<div class="mt-10 bg-white p-6 rounded-xl shadow-md border">
    <h2 class="text-xl font-semibold mb-4">Sales Overview</h2>

    <div class="flex justify-center items-center h-64 text-gray-400">
        <span>Chart Coming Soon…</span>
    </div>
</div>

@endsection

