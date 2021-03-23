<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="/css/act_printBlank.css">

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
    <header>
        <div class="no-print page-header">
            <button class="page-header__button" onclick="window.print()">Печатать</button>
            <a class="page-header__link js-link" href="{{ route('act-approval') }}">Назад</a>
        </div>
    </header>

    <main class="main">
        <section class="act-print">
            <div class="main-info">
                <h2 class="main-info__head">Акт-допуск для производства работ на территории организации</h2>
                <div class="main-info__city-date">
                    <div class="main-info__city-date_column">
                        <span>г. Краснодар</span>
                        <span class="main_border-top">(место составления)</span>
                    </div>
                    <div class="main-info__city-date_column">
                        <span>15 июня 2020г.</span>
                        <span class="main_border-top">(дата)</span>
                    </div>
                </div> 

                <p class="main__paragraph-claas">ООО "КЛААС"</p>
                <p class="main_border-top">(наименование действующего производственного объекта)</p>

                <p class="main__paragraph-employee">1. Мы, нижеподписавшиеся, представитель организации</p>
                <p class="main__paragraph-employee-name">{{$printData->employee->surname}} {{$printData->employee->name}} {{$printData->employee->patronymic}}</p>
                <p class="main_border-top">(ФИО., должность)</p>

                <p class="main__paragraph-contractor">представитель подрядчика</p>
                <p class="main__paragraph-contractor-name">{{$printData->visitor->surname}} {{$printData->visitor->name}} {{$printData->visitor->patronymic}}</p>
                <p class="main_border-top">(ФИО., должность)</p>

                <p class="main__paragraph-place-head">составили настоящий акт о нижеследующем.</p>
                <p>Организация предоставляет участок (территорию), ограниченный координатами:</p>

                <p class="main__paragraph-place">{{ $printData->place }}</p>
                <p class="main_border-top">(наименование осей, отметок и номер чертежа)</p>

                <p class="main__paragraph-work-head">для производства на нем:</p>
                <p class="main__paragraph-work">{{ $printData->description }}</p>
                <p class="main_border-top">(наименование работ)</p>

                <p class="main__paragraph-contractors-head">под руководством представителя подрядчика на следующий срок:</p>
                <div class="flex-container_row">
                    <div>
                        <span>начало</span>
                        <span class="main__date">{{ $printData->from_date }}</span>
                    </div>
                    <div>
                        <span>окончание</span>
                        <span class="main__date">{{ $printData->till_date }}</span>
                    </div>  
                </div>
                <div class="main__time-box">
                    <span>время с</span>
                    <span class="main__time">{{ $printData->from_time }}</span>
                    <span>по</span>
                    <span class="main__time">{{ $printData->till_time }}</span>
                    <span class="main__weekend">рабочие и выходные дни</span>
                </div>
            </div>

            <div class="main-include">
                <p class="main-include__elem">2. До начала строительного производства необходимо выполнить следующие мероприятия, обеспечивающие безопасность производства работ:</p>
                <p class="main-include__elem">3. Во время производства работ необходимо выполнять следующие мероприятия, обеспечивающие безопасность производства работ:</p>
                <p class="main-include__elem">4. По завершении производства работ необходимо выполнить следующие мероприятия:</p>
            </div>

            <div class="signature-box">
                <div class="clearfix">
                    <p>Представитель организации</p>
                    <p class="main__signature main_border-top">(подпись)</p>
                </div>
                <div class="signature-box__item clearfix">
                    <p>Представитель подрядчика</p>
                    <p class="main__signature main_border-top">(подпись)</p>
                </div>

                <p class="notes">Примечание: При необходимости производства работ после истечения срока действия настоящего акта-допуска составляется акт-допуск на новый срок.</p>
            </div>
        </section>

        <section class="act-print">
            <h2 class="main__table-name">Приложение №2 План мероприятий "До"/ Appendix №2 Action Plan "Before"</h2>

            <table class="main__table">
                <thead>
                    <tr>
                        <th>Наименование мероприятия</th>
                        <th>Подтип выполняемых работ</th>
                        <th>Срок выполнения</th>
                        <th>Исполнитель</th>
                        <th>Подпись ответственного исполнителя</th>
                        <th>Представитель отдела</th>
                        <th>Подпись представителя отдела</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($printData->checkbox as $arr)
                    @foreach($arr->safetyaction as $array)
                        @if($array->deadline == "До начала работ")
                            <tr>
                                <td>{{$array->name}}</td>
                                <td>{{$arr->description}}</td>
                                <td>{{$array->deadline}}</td>
                                <td>{{$array->performer}}</td>
                                <td></td>
                                <td>{{$array->employee}}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </section>

        @for ($i=0; $i < $countDays; $i++)
        <section class="act-print">
            <h2 class="main__table-name">Приложение №3 План мероприятий "Во время"/ Appendix №3 Action Plan "During"</h2>

            <table class="main__table">
                <thead>
                    <tr>
                        <th>Наименование мероприятия</th>
                        <th>Подтип выполняемых работ</th>
                        <th>Срок выполнения</th>
                        <th>Исполнитель</th>
                        <th>Подпись ответственного исполнителя</th>
                        <th>Представитель отдела</th>
                        <th>Подпись представителя отдела</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($printData->checkbox as $arr)
                    @foreach($arr->safetyaction as $array)
                        @if($array->deadline == "Во время работ")
                            <tr>
                                <td>{{$array->name}}</td>
                                <td>{{$arr->description}}</td>
                                <td>{{$array->deadline}}</td>
                                <td>{{$array->performer}}</td>
                                <td></td>
                                <td>{{$array->employee}}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </section>
        @endfor

        <section>
            <h2 class="main__table-name">Приложение №4 План мероприятий "После"/ Appendix №4 Action Plan "After"</h2>

            <table class="main__table">
                <thead>
                    <tr>
                        <th>Наименование мероприятия</th>
                        <th>Подтип выполняемых работ</th>
                        <th>Срок выполнения</th>
                        <th>Исполнитель</th>
                        <th>Подпись ответственного исполнителя</th>
                        <th>Представитель отдела</th>
                        <th>Подпись представителя отдела</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($printData->checkbox as $arr)
                    @foreach($arr->safetyaction as $array)
                        @if($array->deadline == "После завершения работ")
                            <tr>
                                <td>{{$array->name}}</td>
                                <td>{{$arr->description}}</td>
                                <td>{{$array->deadline}}</td>
                                <td>{{$array->performer}}</td>
                                <td></td>
                                <td>{{$array->employee}}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>