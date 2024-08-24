@extends('admin.layouts.app')
@section('content')
    @if ($routeName == $seoproperty->page_name)
        @include('admin.components.client_feedback.client_feedback_view')
        @include('admin.components.client_feedback.client_feedback_delete')
        @include('admin.components.client_feedback.client_feedback_list')
    @endif
    @include('admin.components.client_feedback.client_feedback_create')
@endsection