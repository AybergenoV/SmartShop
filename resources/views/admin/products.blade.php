@extends('layouts.base')
@section('page-name', __('messages.products'))
@section('title', __('messages.products'))
@section('content')
    @livewire('products')
@endsection
