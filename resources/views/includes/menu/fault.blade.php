@section('fault_menu-item')

<li class="nav-item my-1">
    <button class="navbar-toggler text-primary w-100 px-0" type="button" data-toggle="collapse" data-target="#navbarfault" aria-controls="navbarsExample01" aria-expanded="true" aria-label="Toggle navigation">
        <svg width="24" height="24" viewBox="0 0 16 16" class="bi bi-truck float-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.938 2.016a.146.146 0 0 0-.054.057L1.027 13.74a.176.176 0 0 0-.002.183c.016.03.037.05.054.06.015.01.034.017.066.017h13.713a.12.12 0 0 0 .066-.017.163.163 0 0 0 .055-.06.176.176 0 0 0-.003-.183L8.12 2.073a.146.146 0 0 0-.054-.057A.13.13 0 0 0 8.002 2a.13.13 0 0 0-.064.016zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
        </svg>
    <span class="small">Неисправности</span>
    </button>

    <div class="navbar-collapse collapse" id="navbarfault" style="">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-dark" href="{{ route('fault-new') }}">Новый</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('fault-index') }}">Нерешенные</a>
            </li>
        </ul>
    </div>
</li>
