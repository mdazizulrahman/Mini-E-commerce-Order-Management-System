@extends('admin.layouts.admin')
@section('title', 'Category Management')
@section('content')
@switch(Route::currentRouteName())
    @case('admin.category.create')
        <h1>Create Category</h1>
        @break
    @case('admin.category.edit')
        <h1>Edit Category</h1>
        @break
    @default
    <livewire:backend.admin.category.index />
  @break    
@endswitch

@endsection