<h3>Состав текущей смены охраны</h3>

<ul class="list-group list-group-flush">
    <?php
    foreach ($securityGuys as $arr) {
        $status = '';
        $name = $arr['name'];

        if ($arr['category'] == 'main') {
            $status = 'Старший смены охраны';
        } elseif ($arr['category'] == 'writer') {
            $status = 'Инспектор пропускного режима';
        } else {
            $status = 'Сотрудник охраны';
        }

        echo 
        '<li class="list-group-item">
            <form class="d-flex" action="/security/update/' . $arr["id"] . '" method="POST">
                <label class="col-form-label col-4 font-weight-bold">' . $status . '</label>
                
                <input type="text" 
                name="security" 
                class="form-control capitalize col-6" 
                autocomplete="off" 
                value="' . $name . '">

                <button type="submit" class="btn btn-info ml-auto">Изменить</button>
               
            </form>
        </li>';
    }
    ?>
    
</ul>

<div class="d-flex justify-content-end">
    <a class="btn btn-warning mt-5" href="{{ route('email-security-report')}}">Отправить отчет</a>
</div>
