@extends('layouts.base')
@section('page-name', __('messages.income'))
@section('title', __('messages.income'))
@section('content')
    @livewire('consumption', ['type'=>'income'])
@endsection
