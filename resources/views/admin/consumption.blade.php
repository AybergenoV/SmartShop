@extends('layouts.base')
@section('page-name', __('messages.costs'))
@section('title', __('messages.costs'))
@section('content')
    @livewire('consumption', ['type'=>'consumption'])
@endsection
