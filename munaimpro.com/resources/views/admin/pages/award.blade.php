@extends('admin.layouts.app')
@section('content')
    @include('admin.components.award.award_create')
    @include('admin.components.award.award_update')
    @include('admin.components.award.award_delete')
    @include('admin.components.award.award_list')
@endsection