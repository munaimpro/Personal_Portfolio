@extends('admin.layouts.app')
@section('content')
    {{-- @include('admin.components.pricing.pricing_create') --}}
    @include('admin.components.pricing.pricing_update')
    {{-- @include('admin.components.pricing.pricing_delete') --}}
    @include('admin.components.pricing.pricing_list')
@endsection