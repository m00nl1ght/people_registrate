<div class="logo-box js-logo-box">         
    <h1 class="h5">АКТ-ДОПУСК ДЛЯ ПРОИЗВОДСТВА РАБОТ НА ТЕРРИТОРИИ ООО "КЛААС"</h1>
    <div>
        <span>&#8470;</span>
        <span class="logo-box__number js-act-number"></span>
    </div> 
</div>

<form id="actForm" class="pt-4" method="POST" name="actForm" action="{{ route('act-store') }}">
    @csrf
    <fieldset class="mb-5">
        <legend class="h5">Основные данные</legend>

        <div class="form-group row">
            <label class="col-form-label col-4" for="surnameEmployee">Представитель КЛААС</label>
            <div class="col-6">
                <input class="form-control" type="text"
                        name="surnameEmployee"
                        id="nameEmployee"
                        placeholder="Фамилия">
                <input class="form-control" type="text" name="nameEmployee" placeholder="Имя">
                <input class="form-control" type="text" name="patronymicEmployee" placeholder="Отчество">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-4" for="surnameContractor">Представитель подрядной организации</label>
            <div class="col-6">
                <input class="form-control" type="text" name="surnameContractor" id="nameContractor" placeholder="Фамилия">
                <input class="form-control" type="text" name="nameContractor" placeholder="Имя">
                <input class="form-control" type="text" name="patronymicContractor" placeholder="Отчество">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-4" for="firm">Организация исполнителя</label>
            <div class="col-6">
                <input class="form-control" type="text" name="firm" id="firm">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-4" for="place">Место проведения работ</label>
            <div class="col-6">
                <input class="form-control" type="text" name="place" id="place">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-4" for="description">Описание работ</label>
            <div class="col-6">
                <input class="form-control" type="text" name="description" id="description">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-4" for="instrument">Инструметы и оборудование</label>
            <div class="col-6">
                <input class="form-control" type="text" name="instrument" id="instrument">
            </div>
        </div>
    </fieldset>

    <fieldset class="form-group mb-5 py-3">
        <legend class="h5">Сроки выполнения работ</legend>

        <h3 class="h6 mb-0">Даты выполнения работ</h3>
  
        <div class="row">
                <div class="col-3">
                    <label class="col-form-label" for="dateFrom">C</label>
                    <input class="form-control" type="date" name="dateFrom" id="dateFrom">
                </div>

                <div class="col-3">
                    <label class="col-form-label" for="dateTill">По</label>
                    <input class="form-control" type="date" name="dateTill" id="dateTill">
                </div>
        </div>

        <h3 class="h6 mt-3 mb-0">Время выполнения работ</h3>

        <div class="row">
            <datalist id="time-list">
                <option value="09:00" label="Начало рабочего дня">
                <option value="12:00" label="Обед">
                <option value="18:00" label="Конец рабочего дня">
            </datalist>

            <div class="col-3">
                <label class="col-form-label" for="dateFrom">C</label>
                <input class="form-control" type="time" name="timeFrom" id="timeFrom" list="time-list">
            </div>

            <div class="col-3">
                <label class="col-form-label" for="dateTill">По</label>
                <input class="form-control" type="time" name="timeTill" id="timeTill" list="time-list">
            </div>
        </div>

        <div class="form-check row mt-4 d-flex align-items-center">  
            <input class="" type="checkbox" name="weekend" id="weekend">
            <label class="form-check-label pl-4" for="weekend">Включая выходные</label>
        </div>
    </fieldset>

    <fieldset class="form-group mb-5 py-3" name="maincheckbox" form="actForm">
        <legend class="h5 m-0">Тип выполняемых работ</legend>
        <div class="row d-flex justify-content-between">
        @foreach($main as $arr=>$key)
            <div class="js-checkbox col-3 d-flex flex-column bg-light py-3">
                <label class="h6">
                    <input class="js-checkbox-main" type="checkbox" aria-checked="false" name="{{ $arr }}">
                    {{ $checkboxArr->where('name', '=', $arr)->first()->description }}
                </label>

                @foreach($key as $arr=>$key)
                    <label class="text-secondary">
                    <input class="js-checkbox-sub" type="checkbox" name="{{ $arr }}" disabled>
                    {{ $key }}
                    </label>
                @endforeach
            </div>
        @endforeach
        </div>
        
    </fieldset>

    <fieldset class="form-group mb-5 py-3">
        <legend class="h5 m-0">Подтип выполняемых работ</legend>

        <div class="row d-flex justify-content-between">
        @foreach($sub as $arr=>$key)
            <div class="js-checkbox col-3 d-flex flex-column bg-light py-3">
                <label class="h6">
                    <input class="js-checkbox-main js-checkbox-{{ $arr }}" type="checkbox" aria-checked="false" disabled>
                    {{ $checkboxArr->where('name', '=', $arr)->first()->description }}
                </label>
       
                @foreach($key as $arr=>$key)
                    <label class="text-secondary">
                    <input class="js-checkbox-sub" type="checkbox" name="{{ $arr }}" disabled>
                    {{ $key }}
                    </label>
                @endforeach
            </div>
        @endforeach
        </div>
    </fieldset>

    <button class="btn btn-info" type="submit">Отправить запрос на согласование</button>
</form>