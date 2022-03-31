@extends('layouts.base')
@section('page-name', __('messages.sales'))
@section('title', __('messages.sales'))
@section('content')
    @livewire('orders')
@endsection
