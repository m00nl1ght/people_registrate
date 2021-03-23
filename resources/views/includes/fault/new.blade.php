<form action="{{ route('fault-add-form')}}" method="post">
    @csrf
    <div class="form-group row">
        <label class="col-form-label col-4" for="system">Система</label>
        <div class="col-6">
            <select class="custom-select" name="system">
                <option value="Видеонаблюдение" selected>Видеонаблюдение</option>
                <option value="Охрана периметра">Охрана периметра</option>
                <option value="Пожарная сигнализация">Пожарная сигнализация</option>
                <option value="Контроль доступа">Контроль доступа</option>
                <option value="Другое">Другое</option>
            </select>
            <!-- <select class="custom-select" name="system">
                <option value="svn" selected>Видеонаблюдение</option>
                <option value="op">Охрана периметра</option>
                <option value="apc">Пожарная сигнализация</option>
                <option value="skud">Контроль доступа</option>
                <option value="another">Другое</option>
            </select> -->
        </div>
    </div>

    <div class="form-group row">        
        <label class="col-form-label col-4" for="name">Название</label>
        <div class="col-6">
            <input type="text" name="name" placeholder="Название шлейфа/камеры" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-4" for="place">Расположение</label>
        <div class="col-6">
            <input type="text" name="place" placeholder="Расположение" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-4" for="comment">Комментарий</label>
        <div class="col-6">
            <textarea id="comment" class="form-control" name="comment" placeholder="Комментарий"></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-info">Отправить</button>
</form>