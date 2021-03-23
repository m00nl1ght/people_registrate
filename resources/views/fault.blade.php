@extends('layouts.app')

@section('page-header')Неисправности
@endsection

@section('title-block')Неисправности
@endsection

@section('content')

    @include('includes.messages')

    @if($page == 'new')
        @include('includes.fault.new')
    @elseif($page == 'index')
        @include('includes.fault.index')
    @elseif($page == 'edit')
        @include('includes.fault.edit')
    @endif

@endsection