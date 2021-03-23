@if ($showVisitorArr == null)
    <p class="alert alert-success">Территория пуста, все посетители дома!</p>
@else
<table class="table table-hover">
        <thead>
            <th scope="col">Печать</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Имя</th>
            <th scope="col">Время входа</th>
            <th scope="col">Телефон</th>
            <th scope="col">
                <div class="row justify-content-between">
                    <span>Время выхода</span>
                    <span>Отправить</span>
                </div>
            </th>          
        </thead>
        <tbody>
            <?php foreach($showVisitorArr as $arr) { ?>
            <tr>
                <td>
                    <form action="{{ route('visitor-print',$arr['id']) }}" name="print_visitor_form">   
                            <button  class="btn btn-secondary" type="submit">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-printer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
                                    <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
                                    <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                </svg>
                            </button>
                    </form>
                </td>
                <td><?= $arr['surname'] ?></td>
                <td><?= $arr['name'] ?></td>
                <td><?= $arr['time'] ?></td>
                <td><?= $arr['phone'] ?></td>
                <td>
                    <form action="{{ route('visitor-exit') }}" name="out_visitor_form" method="post">
                        @csrf
                        <div class="row justify-content-between">
                            <input class="d-none" type="text" name="id" value="<?= $arr['id'] ?>">
                            <input type="time" name="out_time" placeholder="время выхода">
                            <button  class="btn btn-info col-4" type="submit">Вышел</button>
                        </div>  
                    </form>
                </td>  
            </tr>
            <?php } ?>
        </tbody>
</table>
@endif