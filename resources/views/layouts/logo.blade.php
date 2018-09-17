@if(isset(session("security")['token'])) <!--Logged in -->
@section('logo')
    <div class="menu">
        <div class="logobar authed">
            <h1>Qnventory</h1>
        </div>
        <div class="menu-items">
            <ul>
                <li class="active"><a href="" v-on:click.prevent="">Dashboard</a></li>
                <li><a href="" v-on:click.prevent>Menu 2</a></li>
                <li><a href="" v-on:click.prevent>Menu 3</a></li>
                <li><a href="" v-on:click.prevent>Menu 4</a></li>
            </ul>
        </div>
    </div>
@endsection
@else <!--NOt logged in -->
@section('logo')
    <div class="logobar unauthed">
        <h1>Qnventory</h1>
    </div>
@endsection
@endif
