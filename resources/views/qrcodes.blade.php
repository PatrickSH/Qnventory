@extends('layouts.root')
@extends('layouts.logo')
@extends('layouts.security')
@extends('layouts.user_data')

@section('content')
    <div id="qrcodes">
        <qr-codes></qr-codes>
    </div>
@endsection
@section('outercontent')
    <modal custom-class="requestnewqrmodel">
        <template slot="title">
            <h2>Request new QR codes.</h2>
        </template>
        <template slot="content">
            <input type="number" max="30" class="amount" placeholder="Amount"/>
        </template>
        <template slot="buttons">
            <button class="bluebutton" v-request-qr-codes>Request<span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <svg class="checkmark" v-bind:class="{active : isDone}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
        </template>
    </modal>
@endsection