@extends('layouts.root')
@extends('layouts.logo')
@extends('layouts.security')

@section('content')
    <first-login-data></first-login-data>
@endsection
@section('outercontent')
    <!--<modal>
        <template slot="title">
            <h2>Welcome to <span class="logo-in-text">Qnventory</span>!</h2>
        </template>
        <template slot="content">
            <p>Since this is your first login we need some info from you.</p>
        </template>
        <template slot="buttons">
            <button name="start" class="noloading-button" v-custom-click>Start!</button>
        </template>
    </modal>-->
@endsection
