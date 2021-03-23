<table class="table table-hover">
        <thead>
            <th scope="col">Печать</th>
            <th scope="col">Номер акта</th>
            <th scope="col">Координатор</th>
            <th scope="col">Представитель подрядчика</th>
            <th scope="col">Организация исполнителя</th>
            <!-- <th scope="col">Описание работ</th>
            <th scope="col">Место проведения</th> -->
            <th scope="col">Дата открытия</th>
            <th scope="col">Дата закрытия</th>          
        </thead>
        <tbody>
            @foreach ($acts as $arr)
            <tr>
                <td>
                    <form action="{{ route('act-print', $arr->id ) }}" name="print_act_form">   
                            <button  class="btn btn-secondary" type="submit">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-printer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
                                    <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
                                    <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                </svg>
                            </button>
                    </form>
                </td>

                <td>{{ $arr->id }}</td>
                <td>{{ $arr->employee->surname }}</td>
                <td>{{ $arr->visitor->surname }}</td>
                <td>{{ $arr->visitor->firm->name }}</td>
                <!-- <td>{{ $arr->description }}</td>
                <td>{{ $arr->place }}</td> -->
                <td>{{ $arr->from_date }}</td>
                <td>{{ $arr->till_date }}</td>

            </tr>
            <tr>
                <td colspan="7">
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