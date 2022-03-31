@extends('layouts.base')
@section('page-name', __('messages.transactions'))
@section('title', __('messages.transactions'))
@section('content')
    @livewire('transaction')
@endsection
