@extends('customer.layouts.customer')

@section('title', 'Dashboard')

@section('content')



<h1 class="text-xl font-bold mb-4">Welcome, {{ auth()->user()->name }}</h1>

<div class="p-6 bg-white shadow rounded">
    <h2 class="text-lg font-semibold">Your Overview</h2>
    <p class="mt-3">Total Orders: <strong></strong></p>
</div>

@endsection

