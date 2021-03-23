@extends('layouts.act_app')

@section('page-header')Акт
@endsection

@section('title-block')Акт
@endsection

@section('content')
    @include('includes.messages')
    
    @include('includes.messages')

    @if($page == 'new')
        @include('includes.act.act_form')
    @elseif($page == 'index')
        @include('includes.act.index')
    @elseif($page == 'approval')
        @include('includes.act.approval')   
    @endif
@endsection