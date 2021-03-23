<table class="table table-hover">
        <thead>
            <th scope="col">Номер акта</th>
            <th scope="col">Координатор</th>
            <th scope="col">Представитель подрядчика</th>
            <th scope="col">Организация исполнителя</th>
            <!-- <th scope="col">Описание работ</th>
            <th scope="col">Место проведения</th> -->
            <th scope="col">Дата открытия</th>
            <th scope="col">Дата закрытия</th>
            <th scope="col">Статус СБ</th>
            <th scope="col">Статус СТО</th>
            <th scope="col">Статус СС</th>
            <th scope="col"></th>
            <th scope="col"></th>            
        </thead>
        <tbody>
            @foreach ($acts as $arr)
            <tr>
                <td>{{ $arr->id }}</td>
                <td>{{ $arr->employee->surname }}</td>
                <td>{{ $arr->visitor->surname }}</td>
                <td>{{ $arr->visitor->firm->name }}</td>
                <!-- <td>{{ $arr->description }}</td>
                <td>{{ $arr->place }}</td> -->
                <td>{{ $arr->from_date }}</td>
                <td>{{ $arr->till_date }}</td>

                <td>{{ $approve[$arr->id]['sd'] }}</td>
                <td>{{ $approve[$arr->id]['sto'] }}</td>
                <td>{{ $approve[$arr->id]['cc'] }}</td>

                <td>
                    <form action="/act/update/{{ $arr->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="approve" value="approve" />
                        <input class="btn btn-success" type="submit" value="Согласовать">
                    </form>
                    </td>
                    <td>
                    <form action="/act/update/{{ $arr->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="approve" value="disapprove" />
                        <input class="btn btn-danger" type="submit" value="Отклонить">
                    </form>
                </td>

            </tr>
            <tr>
                <td colspan="11">
                    <table class="table table-borderless bg-info">
                        <thead>
                            <th>Описание работ</th>
                            <th>Место проведения</th>
                        </thead>
                        <tbody>
                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostru</td>
                            <td>{{ $arr->place }}</td>
                        </tbody>
                    </table>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>