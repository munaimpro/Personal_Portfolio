@extends('admin.layouts.app')
@section('content')
    @include('admin.components.skill.skill_create')
    @include('admin.components.skill.skill_update')
    @include('admin.components.skill.skill_delete')
    @include('admin.components.skill.skill_list')
@endsection