@extends('layouts.base')
@section('page-name', __('messages.warehouse'))
@section('title', __('messages.warehouse'))
@section('content')
    @livewire('warehouse-add')
@endsection
