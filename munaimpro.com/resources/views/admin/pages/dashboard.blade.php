@extends('admin.layouts.app')
@section('content')
    @include('admin.components.dashboard.dashboard_stat')
    @include('admin.components.dashboard.dashboard_project_blog')
    @include('admin.components.dashboard.dashboard_visitorinfo')
    @include('admin.components.dashboard.dashboard_user_message')
    @include('admin.components.dashboard.dashboard_message_reply')
@endsection