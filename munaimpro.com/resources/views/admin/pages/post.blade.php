@extends('admin.layouts.app')
@section('content')
    @include('admin.components.post.post_create')
    @include('admin.components.post.post_update')
    @include('admin.components.post.post_delete')
    @include('admin.components.post.post_list')
@endsection