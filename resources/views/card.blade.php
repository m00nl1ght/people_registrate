@extends('layouts.app')

@section('page-header')Карты доступа
@endsection

@section('title-block')Карты доступа
@endsection

@section('content')

    @include('includes.messages')

    @switch($page)
        @case('create')
            @include('includes.card.create')
            @break

        @case('create-employee')
            @include('includes.card.createemployee')
            @break

        @case('income-index')
            @include('includes.card.income_index')
            @break
        
        @case('index')
            @include('includes.card.index')
            @break
    @endswitch

@endsection