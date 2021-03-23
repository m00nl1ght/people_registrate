<table class="table table-hover">
        <thead>
            <th scope="col">Фамилия/Имя</th>
            <th scope="col">Номер пропуска</th>
            <th scope="col">Время входа</th>
            <th scope="col">
                <div class="row justify-content-between">
                    <span>Время выхода</span>
                    <span>Отправить</span>
                </div>
            </th>
            
        </thead>
        <tbody>
            @foreach($incCard as $arr)
            <tr>
                <td>{{ $arr->employee->first()->surname }} {{ $arr->employee->first()->name }}</td>
                <td>{{ $arr->card->number }}</td>
                <td>{{ $arr->in_time }}</td>             
                <td>
                    <form action="{{ action('IncomeCardController@update', ['id' => $arr->id]) }}" name="out_card_form" method="POST">
                        @csrf
                        <div class="row justify-content-between">
                            <input type="time" name="out_time" placeholder="время выхода">
                            <button  class="btn btn-info col-4" type="submit">Вышел</button>
                        </div>  
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>
