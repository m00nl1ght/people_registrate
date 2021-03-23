<form action="{{ route('card-store-employee')}}" method="post">
    @csrf

    @include('includes.items.formElemEmployee')

    <div class="form-group row">        
        <label class="col-form-label col-4" for="employee_position">Должность сотрудника</label>
        <div class="col-6">
            <input id="employee_position"  class="form-control" type="text" name="employee_position" placeholder="Должность сотрудника">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-4" for="employee_boss_surname">Руководитель сотрудника11</label>
        <div class="col-2">
            <input id="employee_boss_surname" class="form-control capitalize" type="text" name="employee_boss_surname" placeholder="Фамилия" autocomplete="off" value="{{ old('employee_boss_surname') }}">
        </div>
        <div class="col-2">
            <input id="employee_boss_name" class="form-control capitalize" type="text" name="employee_boss_name" placeholder="Имя" value="{{ old('employee_boss_name') }}">
        </div>
        <div class="col-2">
            <input id="employee_boss_patronymic" class="form-control capitalize" type="text" name="employee_boss_patronymic" placeholder="Отчество" value="{{ old('employee_boss_patronymic') }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-4" for="employee_boss_position">Должность руководителя</label>
        <div class="col-6">
            <input id="employee_boss_position" class="form-control" type="tel" name="employee_boss_position" placeholder="Должность руководителя">
        </div>
    </div>

    @include('includes.items.formElemCard')

    <button type="submit" class="btn btn-info">Отправить</button>
</form>