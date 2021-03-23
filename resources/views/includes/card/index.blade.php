<table class="table table-hover">
        <thead>
            <th scope="col">Категория</th>
            <th scope="col">Номер пропуска</th>
            <th scope="col">Удалить</th>
            
        </thead>
        <tbody>
            @foreach ($cards as $arr)
            <tr>
                <td>{{ $arr->cardcategory->description }}</td>
                <td>{{ $arr->number }}</td>           
                <td>
                    <form method="POST" action="{{action('CardController@destroy', ['id' => $arr->id])}}" name="del_card_form">
                        @csrf   
                        <div class="row justify-content-around">
                            <input class="d-none" type="text" name="id" value="{{ $arr->id }}">

                            <button  class="btn btn-danger" type="submit">Удалить</button>
                        </div>  
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>