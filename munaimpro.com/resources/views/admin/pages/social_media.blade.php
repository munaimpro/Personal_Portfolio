@extends('admin.layouts.app')
@section('content')
    @include('admin.components.social_media.social_media_create')
    @include('admin.components.social_media.social_media_update')
    @include('admin.components.social_media.social_media_delete')
    @include('admin.components.social_media.social_media_list')
@endsection