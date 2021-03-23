<form action="/fault/update/{{ $fault->id }}" method="post">
    @csrf
    <div class="row justify-content-end mb-4">
        <a href="/fault/destroy/<?= $fault->id ?>" class="btn btn-danger">Удалить</a>
    </div>
    
    <div class="form-group row">
        <label class="col-form-label col-4" for="system">Система</label>
        <div class="col-6">
            <p class="form-control">{{ $fault->system }}</p>
            <!-- <textarea id="system"  name="system" placeholder="Система" ></textarea> -->
        </div>
    </div>

    <div class="form-group row">        
        <label class="col-form-label col-4" for="name">Название</label>
        <div class="col-6">
            <textarea id="name" class="form-control" name="name" placeholder="Название"><?= $fault->name?></textarea>
        </div>
    </div>

    <div class="form-group row">        
        <label class="col-form-label col-4" for="place">Название</label>
        <div class="col-6">
            <input id="place" class="form-control" name="place" placeholder="Название" value="{{ $fault->place }}"></input>
        </div>
    </div>

    <div class="form-group row">        
        <label class="col-form-label col-4" for="comment">Комментарий</label>
        <div class="col-6">
            <textarea id="comment" class="form-control" name="comment" placeholder="Комментарий"><?= $fault->comment?></textarea>
        </div>
    </div>

    <div class="form-group row">        
        <label class="col-form-label col-4" for="in_time">Время проишествия</label>
        <div class="col-6">
            <input id="in_time" type="time" name="in_time" placeholder="время входа" value="<?= $fault->in_time?>">
        </div>
    </div>

    <div class="row justify-content-end mb-4">
        <button type="submit" class="btn btn-warning mt-3">Изменить</button>
    </div>

</form>

<form class="mt-5" action="/fault/close/{{ $fault->id }}" name="out_car_form" method="POST">
    @csrf
    <div class="form-group row">        
        <label class="col-form-label col-4" for="out_time">Дата решения</label>
        <div class="col-6">
            <input id="out_time" type="date" name="out_time" placeholder="Дата решения">
        </div>
    </div>

    <div class="row justify-content-end mb-4">
        <button  class="btn btn-info" type="submit">Решено</button>
    </div>
</form>