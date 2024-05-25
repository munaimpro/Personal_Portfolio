@extends('admin.layouts.app')
@section('content')
    @include('admin.components.message.message_send')
    @include('admin.components.message.message_view')
    @include('admin.components.message.message_delete')
    @include('admin.components.message.message_reply')
    @include('admin.components.message.message_list')
@endsection