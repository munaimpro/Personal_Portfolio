@extends('admin.layouts.app')
@section('content')
    @include('admin.components.interest.interest_create')
    @include('admin.components.interest.interest_update')
    @include('admin.components.interest.interest_delete')
    @include('admin.components.interest.interest_list')
@endsection