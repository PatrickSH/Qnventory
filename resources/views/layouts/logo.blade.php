@if(isset(session("user")->logins) && session("user")->logins >= 1) <!--Logged in -->
@section('logo')
    <div class="menu">
        <div class="logobar authed">
            <h1>Qnventory</h1>
        </div>
        <div class="menu-items">
            <ul>
                <li <?php echo Request::is('dashboard') ? 'class=active' :  ''; ?>><a href="/dashboard">Dashboard</a></li>
                <li <?php echo Request::is('codes') ? 'class=active' :  ''; ?>><a href="/codes">Your QR codes</a></li>
                <li <?php echo Request::is('category') ? 'class=active' :  ''; ?>><a href="/category">Categories</a></li>
                <li><a href="" v-on:click.prevent>Menu 4</a></li>
            </ul>
        </div>
        <organizations></organizations>
    </div>
    <user-image></user-image>
@endsection
@else <!--NOt logged in -->
@section('logo')
    <div class="logobar unauthed">
        <h1>Qnventory</h1>
    </div>
@endsection
@endif
