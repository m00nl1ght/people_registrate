<div class="form-group row">
    <label class="col-form-label col-4" for="card_id">Выдан пропуск №</label>
    <div class="col-6">
        <select id="card_id" class="custom-select" name="card_id" value="{{ old('card_number') }}">
            @foreach ($cards as $row)
                <option value="{{ $row->id }}"
                    @if ($loop->first)
                        selected
                    @endif
                >{{ $row->number }}</option>
            @endforeach
        </select>
    </div>
</div>