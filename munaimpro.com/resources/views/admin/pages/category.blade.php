@extends('admin.layouts.app')
@section('content')
    @include('admin.components.category.category_create')
    @include('admin.components.category.category_update')
    @include('admin.components.category.category_delete')
    @include('admin.components.category.category_list')
@endsection