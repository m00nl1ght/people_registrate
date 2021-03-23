<div class="form-group row">
    <label class="col-form-label col-4" for="visitor_category">Категория</label>
    <div class="col-6">
        <select id="visitor_category" class="custom-select" name="visitor_category" value="{{ old('visitor_category') }}">
            @foreach ($category as $row)

                <option value="{{ $row->name }}"
                    @if ( !old('visitor_category'))
                        @if ($loop->first)
                            selected
                        @endif
                    @elseif (old('visitor_category') == $row->name)
                        selected
                    @endif
                >{{ $row->description }}</option>
            @endforeach
        </select>
    </div>
</div>