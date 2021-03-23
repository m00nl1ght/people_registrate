<form class="js-visitor-form" action="{{ route('car-add-form')}}" method="post">
    @csrf

    @include('includes.items.formElemVisitor')
    @include('includes.items.formElemCar')
    @include('includes.items.formElemCategory')
    @include('includes.items.formElemEmployee')
    @include('includes.items.formElemSecurity')

    <button type="submit" class="btn btn-info">Сохранить</button>
</form>