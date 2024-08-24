@extends('admin.layouts.app')
@section('content')
    @if ($routeName == $seoproperty->page_name)
        @include('admin.components.client_feedback.client_feedback_view')
        @include('admin.components.client_feedback.client_feedback_delete')
        @include('admin.components.client_feedback.client_feedback_list')
    @else
        @include('admin.components.client_feedback.client_feedback_create')
    @endif
@endsection