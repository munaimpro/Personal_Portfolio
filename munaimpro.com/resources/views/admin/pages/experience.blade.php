@extends('admin.layouts.app')
@section('content')
    @include('admin.components.experience.experience_create')
    @include('admin.components.experience.experience_update')
    @include('admin.components.experience.experience_delete')
    @include('admin.components.experience.experience_list')
@endsection