@extends('admin.layouts.admin')
@section('title', 'Category Management')
@section('content')
@switch(Route::currentRouteName())
    @case('admin.category.create')
         <livewire:backend.admin.category.create />
        
        @break
   @case('admin.category.edit')
    <livewire:backend.admin.category.edit :id="request()->route('id')" />
@break
    @default
    <livewire:backend.admin.category.index />
  @break    
@endswitch

@endsection