@extends('layouts.app')

@section('page-header')Отчет за смену
@endsection

@section('title-block')Отчет за смену
@endsection

@section('content')
    @include('includes.messages')

    <div class="row  border-bottom pb-3">
        <form method="POST" class="d-flex justify-content-between" action="{{ route('security-report-post') }}">
            @csrf
            <label class="col-form-label col-4" for="date">Показать отчет за</label>
            <input id="date" class="form-control" type="date" name="reportDate">

            <button class="btn btn-primary ml-5" type="submit">Показать&nbsp;отчет</button>
        </form>    
    </div>

    <h3 class="py-4">Дежурная сводка охраны за {{ $reportDay }} - {{ $reportDayTomorrow }} число</h3>

    <div class="row d-flex justify-content-end">
        <div class="col-3">
            <h5>Состав Смены</h5>

            <ul class="list-group list-group-flush">
                @foreach ($securityGuys as $arr)
                    <li class="list-group-item py-2">{{ $arr->name }}</li>
                @endforeach
            </ul>
        </div>
        
    </div>

    <div class="row mt-4">
        <h4>Нерешенные неисправности</h4>

        <table class="table table-hover">
            <thead class="table-info">
                <th scope="col">Система</th>
                <th scope="col">Название</th>
                <th scope="col">Место</th>
                <th scope="col">Комментарий</th>
                <th scope="col">Дата возникновения</th>       
            </thead>
            <tbody>
                @foreach ($faults as $arr)
                    <tr>
                        <td>{{ $arr->system }}</td>
                        <td>{{ $arr->name }}</td>
                        <td>{{ $arr->place }}</td>
                        <td>{{ $arr->comment }}</td>
                        <td>{{ $arr->currentdate->MyDateFormat }}</td>             
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="row mt-4">
        <h4>Проишествия</h4>

        <table class="table table-hover">
            <thead class="table-info">
                <th scope="col">Описание</th>
                <th scope="col">Принятые меры</th>
                <th scope="col">Время</th>  
            </thead>
            <tbody>
                @foreach ($incidents as $arr)
                    <tr>
                        <td>{{ $arr->description }}</td>
                        <td>{{ $arr->action }}</td>
                        <td>{{ $arr->MyTimeFormat }}</td>          
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mt-4">
        <h4>Забытые карты</h4>

        <table class="table table-hover">
            <thead class="table-info">
                <th scope="col">Отсутствие пропусков</th>
                <th scope="col">Принятые меры</th>
            </thead>
            <tbody>
                @foreach ($foggotenPass as $arr)
                    @if ( !$arr->employee->isEmpty() )
                    <tr>
                        <td>При прохождении через КПП, сотрудник {{ $arr->employee[0]->surname }} 
                            {{ mb_substr($arr->employee[0]->name, 0, 1) }}. 
                            {{ mb_substr($arr->employee[0]->patronymic, 0, 1) }}., 
                            {{ $arr->employee[0]->position }}, 
                            информировал сотрудников охраны о забытии пропуска.
                        </td>
                        <td>Проинформирован {{ $arr->employee[1]->surname }} 
                            {{ mb_substr($arr->employee[1]->name, 0, 1) }}. 
                            {{ mb_substr($arr->employee[1]->patronymic, 0, 1) }}., 
                            {{ $arr->employee[1]->position }}. Выдан пропуск № {{$arr->card->number}}.
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <ul>

        </ul>
    </div>



    <div class="row">
        <div class="col">
            <h5>Автотранспорт</h5>
            <ul class="list-group">
            @foreach ($countCarArr as $array=>$key)            
                <li class="list-group-item">
                    <span>{{ $array }}</span>
                    <span>{{ $key }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col">
            <h5>Посетители</h5>
            <ul class="list-group">     
                @foreach ($countPeopleArr as $array=>$key)            
                <li class="list-group-item">
                    <span>{{ $array }}</span>
                    <span>{{ $key }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection