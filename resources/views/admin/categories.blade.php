@extends('layouts.base')
@section('page-name', __('messages.category'))
@section('title', __('messages.category'))
@section('content')
    @livewire('categories')
@endsection
