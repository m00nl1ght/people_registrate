@section('header')

<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <img class="mr-5" src="{{asset('img/claas-logo-right.jpg')}}" alt="Логотип компании">

  <h5 class="my-0 mr-md-auto">@yield('page-header')</h5>

  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="/">КПП 1</a>
    <a class="p-2 text-dark" href="{{ route('act-form') }}">Акт-допуск</a>
  </nav>

  @if(Auth::check())
  <form action="/logout" method="POST">
    @csrf
    <!-- <span>{{Auth::user()->name}}</span> -->
    <button class="btn btn-outline-primary" type="submit">{{Auth::user()->name}}    Выйти</button>
  </form>
  @else
  <a class="btn btn-outline-primary" href="/login">Войти</a>
  @endif
</header>