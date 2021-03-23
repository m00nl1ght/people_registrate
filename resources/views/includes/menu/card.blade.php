@section('card_menu-item')

<li class="nav-item my-1">
    <button class="navbar-toggler text-primary w-100 px-0" type="button" data-toggle="collapse" data-target="#navbarcard" aria-controls="navbarsExample01" aria-expanded="true" aria-label="Toggle navigation">
        <svg width="24" height="24" viewBox="0 0 16 16" class="bi bi-truck float-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
        </svg>
        <span class="small">Карты</span>
    </button>

    <div class="navbar-collapse collapse" id="navbarcard" style="">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-dark" href="{{ route('card-create-employee') }}">Выдать сотруднику</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('incomecard-index') }}">Выданные</a>
            </li>

            <li class="nav-item active">
                <a class="nav-link text-dark" href="{{ route('card-create') }}">Новая карта</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link text-dark" href="{{ route('card-index') }}">Список карт</span></a>
            </li>
        </ul>
    </div>
</li>