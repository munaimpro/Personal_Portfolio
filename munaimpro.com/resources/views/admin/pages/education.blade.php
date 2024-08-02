@extends('admin.layouts.app')
@section('content')
    @include('admin.components.education.education_create')
    @include('admin.components.education.education_update')
    @include('admin.components.education.education_delete')
    @include('admin.components.education.education_list')

    <script>
        hideLoader();
    </script>
@endsection