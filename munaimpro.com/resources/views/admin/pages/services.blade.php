@extends('admin.layouts.app')
@section('content')
    @include('admin.components.services.services_create')
    @include('admin.components.services.services_update')
    @include('admin.components.services.services_delete')
    @include('admin.components.services.services_list')
@endsection