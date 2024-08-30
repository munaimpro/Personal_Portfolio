@extends('admin.layouts.app')
@section('content')
    @include('admin.components.portfolio.portfolio_create')
    @include('admin.components.portfolio.portfolio_update')
    @include('admin.components.portfolio.portfolio_delete')
    @include('admin.components.portfolio.portfolio_list')
@endsection