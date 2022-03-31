@extends('layouts.base')
@section('page-name', __('messages.defect'))
@section('title', __('messages.defect'))
@section('content')
    @livewire('defect-show')
@endsection
