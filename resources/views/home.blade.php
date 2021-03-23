@extends('layouts.app')

@section('page-header')Главная
@endsection

@section('title-block')Home
@endsection

@section('content')

    <div class="col">
        <h1 class="row">Главная страница</h1>
        <img class="row mx-auto mt-5" src="{{asset('img/start-picture.jpg')}}" alt="Стартовая картинка">
    </div>

@endsection