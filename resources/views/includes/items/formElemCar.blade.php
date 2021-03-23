<div class="form-group row">
    <label class="col-form-label col-4" for="visitor_car_number">Номер авто</label>
    <div class="col-6">
        <input id="visitor_car_number"
            class="form-control"
            type="text" 
            name="visitor_car_number" 
            placeholder="Номер авто" 
            value="{{ old('visitor_car_number') }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label col-4" for="visitor_car_model">Модель авто</label>
    <div class="col-6">
        <input id="visitor_car_model"
            class="form-control capitalize"
            type="text" 
            name="visitor_car_model" 
            placeholder="Модель авто" 
            value="{{ old('visitor_car_model') }}">
    </div>
</div>