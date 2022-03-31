@extends('layouts.base')
@section('page-name', __('messages.clients'))
@section('title', __('messages.clients'))
@section('content')
    @livewire('clients')
@endsection
