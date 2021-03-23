<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Document</title>
</head>
<body>
    <table class="main-table" style="width: 960px; margin: 0 auto;">
        <tr>
            <td colspan="12">
                <a class="report-link" 
                href="{{ $url }}" 
                style="font-size: 16px;">Показать отчет в браузере</a>
            </td>
        </tr>

        <tr>
            <td colspan="12" style="border-bottom: 1px solid #000;">
                <h1 class="py-4">Дежурная сводка охраны за {{ $reportDay }} - {{ $reportDayTomorrow }} число</h3>
            </td>
        </tr>

        <tr>
            <td colspan="4" style="width: 33%;"></td>
            <td colspan="4" style="width: 33%;"></td>
            <td colspan="4" style="width: 33%;">
                <h2>Состав Смены:</h2>

                <ul>
                    @foreach ($securityGuys as $arr)
                        <li>{{ $arr->name }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>

        <tr>
            <td colspan="12">
                <table style="width: 100%; margin-bottom: 20px;">
                    <tr>
                        <th colspan="4" style="padding: 10px 10px;
                        text-align: start;
                        font-size: large;
                        border-bottom: 1px solid #000;">Проишествия</th>
                    </tr>

                    <tr>
                        <th>Описание</th>
                        <th>Принятые меры</th>
                        <th>Время</th>  
                    </tr>

                    @foreach ($incidents as $arr)
                        <tr>
                            <td>{{ $arr->description }}</td>
                            <td>{{ $arr->action }}</td>
                            <td>{{ $arr->MyTimeFormat }}</td>          
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="12">
                <table style="width: 100%; margin-bottom: 20px;">
                    <tr>
                        <th colspan="4" style="padding: 10px 10px;
                        text-align: start;
                        font-size: large;
                        border-bottom: 1px solid #000;">Нерешенные неисправности</th>
                    </tr>
                    <tr>
                        <th>Система</th>
                        <th>Название</th>
                        <th>Место</th>
                        <th>Дата возникновения</th>
                    </tr>

                    @foreach ($faults as $arr)
                        <tr>
                            <td>{{ $arr->system }}</td>
                            <td>{{ $arr->name }}</td>
                            <td>{{ $arr->place }}</td>
                            <td>{{ $arr->currentdate->MyDateFormat }}</td>             
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="12">
                <table style="width: 100%; margin-bottom: 20px;">
                    <tr>
                        <th colspan="4" style="padding: 10px 10px;
                        text-align: start;
                        font-size: large;
                        border-bottom: 1px solid #000;">Забытые пропуска</th>
                    </tr>
                    <tr>
                        <th scope="col">Отсутствие пропусков</th>
                        <th scope="col">Принятые меры</th>
                    </tr>

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
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="6" style="width: 50%;">
                <table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
                    <tr>
                        <th colspan="2" style="border: 1px solid #000; padding: 5px 10px;">Автотранспорт</th>
                    </tr>

                    @foreach ($countCarArr as $array=>$key)
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px;">{{ $array }}</td>
                            <td style="border: 1px solid #000; padding: 5px 10px;">{{ $key }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>

            <td colspan="6" style="width: 50%;">
                <table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
                    <tr>
                        <th colspan="2" style="border: 1px solid #000; padding: 5px 10px;">Посетители</th>
                    </tr>

                    @foreach ($countPeopleArr as $array=>$key)
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px;">{{ $array }}</td>
                            <td style="border: 1px solid #000; padding: 5px 10px;">{{ $key }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>

</body>
</html>