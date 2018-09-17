@if(isset(session("security")['token'])) <!--Logged in -->

@else <!--NOt logged in -->

@endif
@section('logo')
    <div class="logobar">
        <h1>Qnventory</h1>
    </div>
@endsection