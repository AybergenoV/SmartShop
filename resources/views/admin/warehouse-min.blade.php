@extends('layouts.base')
@section('page-name', __('messages.little_remaining_goods'))
@section('title', __('messages.little_remaining_goods'))
@section('content')
    @livewire('minus-warehouse')
@endsection
