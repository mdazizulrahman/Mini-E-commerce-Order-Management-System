@extends('admin.layouts.admin')
@section('title', 'Order Management')
@section('content') 

@switch(Route::currentRouteName())
    @case('admin.orders.list')
         <livewire:backend.admin.orders.list />
        
        @break
    @default
    <livewire:backend.admin.orders.order-list />
  @break
@endswitch
  @endsection