<form action="/incident/update/<?= $incident->id ?>" method="post">
    @csrf
    <div class="row justify-content-end mb-4">
        <a href="/incident/destroy/{{ $incident->id }}" class="btn btn-danger">Удалить</a>
    </div>
    
    <div class="form-group row">
        <label class="col-form-label col-4" for="description">Описание</label>
        <div class="col-6">
            <textarea id="descriptpon" class="form-control" name="description" placeholder="Описание">{{ $incident->description }}</textarea>
        </div>
    </div>

    <div class="form-group row">        
        <label class="col-form-label col-4" for="measure">Принятые меры</label>
        <div class="col-6">
            <textarea id="measure" class="form-control" name="action" placeholder="Принятые меры"> {{ $incident->action }}</textarea>
        </div>
    </div>

    <div class="form-group row">        
        <label class="col-form-label col-4" for="in_time">Время проишествия</label>
        <div class="col-6">
            <input id="in_time" type="time" name="in_time" placeholder="время входа" value="{{ $incident->MyTimeFormat }}">
        </div>
    </div>
    
    <div class="row justify-content-end mb-4">
        <button type="submit" class="btn btn-warning mt-3">Изменить</button>
    </div>
</form>