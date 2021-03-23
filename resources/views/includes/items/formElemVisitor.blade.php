<div class="form-group row">
    <label class="col-form-label col-4" for="visitor_surname">Фамилия</label>
    <div class="col-6">
        <input id="visitor_surname" class="form-control capitalize" type="text" name="visitor_surname" placeholder="Фамилия" autocomplete="off" value="{{ old('visitor_surname') }}">
    </div>
</div>

<div class="form-group row">        
    <label class="col-form-label col-4" for="visitor_name">Имя</label>
    <div class="col-6">
        <input id="visitor_name" class="form-control capitalize" type="text" name="visitor_name" placeholder="Имя" value="{{ old('visitor_name') }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label col-4" for="visitor_patronymic">Отчество</label>
    <div class="col-6">
        <input id="visitor_patronymic"  class="form-control capitalize" type="text" name="visitor_patronymic" placeholder="Отчество" value="{{ old('visitor_patronymic') }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label col-4" for="visitor_phone">Номер телефона</label>
    <div class="col-6">
        <input id="visitor_phone"  type="tel" name="visitor_phone" placeholder="Номер телефона" class="form-control"  value="{{ old('visitor_phone') }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label col-4" for="visitor_firm">Организация</label>
    <div class="col-6">
        <input id="visitor_firm" class="form-control capitalize" type="text" name="visitor_firm" placeholder="Организация" value="{{ old('visitor_firm') }}">
    </div>
</div>