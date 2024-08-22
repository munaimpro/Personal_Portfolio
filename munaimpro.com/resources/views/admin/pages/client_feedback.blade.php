@extends('admin.layouts.app')
@section('content')
    {{-- @include('admin.components.client_feedback.client_feedback_view') --}}
    {{-- @include('admin.components.client_feedback.client_feedback_delete') --}}
    @include('admin.components.client_feedback.client_feedback_list')
@endsection