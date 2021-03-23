@section('incident_menu-item')

<li class="nav-item my-1">
    <button class="navbar-toggler text-primary w-100 px-0" type="button" data-toggle="collapse" data-target="#navbarincident" aria-controls="navbarsExample01" aria-expanded="true" aria-label="Toggle navigation">
        <svg width="24" height="24" viewBox="0 0 16 16" class="bi bi-truck float-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
        </svg>
    <span class="small">События</span>
    </button>

    <div class="navbar-collapse collapse" id="navbarincident" style="">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-dark" href="{{ route('incident-new') }}">Новый</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('incident-index') }}">За смену</a>
            </li>
        </ul>
    </div>
</li>
