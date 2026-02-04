@extends('admin.layouts.admin')
@section('title', 'Product Management')
@section('content')
@switch(Route::currentRouteName())
    @case('admin.product.product-create')
         <livewire:backend.admin.product.product-create />
        
        @break
 @case('admin.product.product-edit')
        {{-- এডিটের সময় কন্ট্রোলার থেকে আসা $id পাস হবে --}}
        <livewire:backend.admin.product.product-edit :id="request()->route('id')" />
        @break
    @default
    <livewire:backend.admin.product.product-list />
  @break    
@endswitch

@endsection