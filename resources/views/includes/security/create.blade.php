<form class="js-security-add-form" action="{{ route('security-store') }}" method="post">
    @csrf
    <div class="form-group row">
        <label class="col-form-label col-4" for="sec_main">Старший смены охраны</label>
        <div class="col-6">
            <input type="text" 
                name="sec_main" 
                placeholder="Старший смены охраны" 
                class="form-control capitalize" 
                value="{{ old('sec_main') }}" 
                autocomplete="off">
        </div>
    </div>

    <div class="form-group row">        
        <label class="col-form-label col-4" for="sec_writer">Инспектор пропускного режима</label>
        <div class="col-6">
            <input type="text" name="sec_writer" placeholder="Инспектор пропускного режима" class="form-control capitalize" value="{{ old('sec_writer') }}" autocomplete="off">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-4" for="sec_1">Оператор видеонаблюдения</label>
        <div class="col-6">
            <input type="text" name="sec_1" placeholder="Оператор видеонаблюдения" class="form-control capitalize" value="{{ old('sec_1') }}" autocomplete="off">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-4" for="sec_2">Ночная смена охраны 1</label>
        <div class="col-6">
            <input type="text" name="sec_2" placeholder="Ночная смена охраны 1" class="form-control capitalize" value="{{ old('sec_2') }}" autocomplete="off">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-4" for="sec_3">Ночная смена охраны 2</label>
        <div class="col-6">
            <input type="text" name="sec_3" placeholder="Ночная смена охраны 2" class="form-control capitalize" value="{{ old('sec_3') }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-4" for="sec_4">Резерв</label>
        <div class="col-6">
            <input type="text" name="sec_4" placeholder="Резерв" class="form-control capitalize" value="{{ old('sec_4') }}">
        </div>
    </div>

    <button type="submit" class="btn btn-info">Сохранить</button>
</form>