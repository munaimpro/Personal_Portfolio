@extends('admin.layouts.app')
@section('content')
    @include('admin.components.user.user_update')
    @include('admin.components.user.user_delete')
    @include('admin.components.user.user_list')
@endsection