@extends('admin.layouts.app')
@section('content')
    @include('admin.components.seoproperty.seoproperty_update')
    @include('admin.components.seoproperty.seoproperty_delete')
    @include('admin.components.seoproperty.seoproperty_logo')
    @include('admin.components.seoproperty.seoproperty_list')
@endsection