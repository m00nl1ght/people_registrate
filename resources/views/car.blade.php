@extends('layouts.app')

@section('page-header')Автомобили
@endsection

@section('title-block')Автомобили
@endsection

@section('content')

    @include('includes.messages')

    @if($page == 'new')
        @include('includes.car.new')
    @elseif($page == 'index')
        @include('includes.car.index')   
    @endif

@endsection