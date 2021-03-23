<div class="form-group row">
    <label class="col-form-label col-4" for="visitor_employee_surname">Сотрудник Клаас</label>
    <div class="col-2">
        <input id="visitor_employee_surname" class="form-control capitalize" type="text" name="employee_surname" placeholder="Фамилия" autocomplete="off" value="{{ old('employee_surname') }}">
    </div>
    <div class="col-2">
        <input id="visitor_employee_name" class="form-control capitalize" type="text" name="employee_name" placeholder="Имя" value="{{ old('employee_name') }}">
    </div>
    <div class="col-2">
        <input id="visitor_employee_patronymic" class="form-control capitalize" type="text" name="employee_patronymic" placeholder="Отчество" value="{{ old('employee_patronymic') }}">
    </div>
</div>