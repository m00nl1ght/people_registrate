@extends('layouts.app')

@section('page-header')События
@endsection

@section('title-block')События
@endsection

@section('content')

    @include('includes.messages')
    @include('includes.incident.' . $page)

@endsection