@extends('layouts.app')

@section('page-header')Посетители
@endsection

@section('title-block')Посетители
@endsection

@section('content')

    @include('includes.messages')

    @if($page == 'new')
        @include('includes.visitor.new')
    @elseif($page == 'index')
        @include('includes.visitor.index')   
    @endif

@endsection