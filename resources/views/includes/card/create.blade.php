<form action="{{ route('card-store')}}" method="post">
    @csrf

    <div class="form-group row">        
        <label class="col-form-label col-4" for="card_number">Номер карты</label>
        <div class="col-6">
            <input id="card_number"  class="form-control" type="text" name="card_number" placeholder="Номер карты">
        </div>
    </div>


    <div class="form-group row">
        <label class="col-form-label col-4" for="card_category">Категория</label>
        <div class="col-6">
            <select id="card_category" class="custom-select" name="card_category" value="{{ old('card_category') }}">
                @foreach ($card_category as $row)
                    <option value="{{ $row->id }}"
                        @if ($loop->first)
                            selected
                        @endif
                    >{{ $row->description }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-info">Сохранить</button>
</form>