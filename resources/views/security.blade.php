@extends('layouts.app')

@section('page-header')Состав смены
@endsection

@section('title-block')Security
@endsection

@section('content')

    @include('includes.messages')

    @if($page == 'create')
        @include('includes.security.create') 
    @elseif($page == 'edit')
        @include('includes.security.edit')  
    @endif

@endsection