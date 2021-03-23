@section('car_menu-item')

<li class="nav-item my-1">
    <button class="navbar-toggler text-primary w-100 px-0" type="button" data-toggle="collapse" data-target="#navbarcar" aria-controls="navbarsExample01" aria-expanded="true" aria-label="Toggle navigation">
        <svg width="24" height="24" viewBox="0 0 16 16" class="bi bi-truck float-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5v7h-1v-7a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5v1A1.5 1.5 0 0 1 0 10.5v-7zM4.5 11h6v1h-6v-1z"/>
            <path fill-rule="evenodd" d="M11 5h2.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5h-1v-1h1a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4.5h-1V5zm-8 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
            <path fill-rule="evenodd" d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
        </svg>
    <span class="small">Авто</span>
    </button>

    <div class="navbar-collapse collapse" id="navbarcar" style="">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-dark" href="{{ route('car-new') }}">Новый</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('car-index') }}">На территории</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Отчет</a>
            </li>
        </ul>
    </div>
</li>
