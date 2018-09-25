@extends('layouts.root')

@section('custom_meta')
    <meta property="org_id" content="{{ $org_id }}">
    <meta property="code_uid" content="{{ $code_uid }}">
@endsection

@section('content')
    <div id="use-code-scan">
        <h1>Qnventory</h1>
        <use-qr-code-scan></use-qr-code-scan>
    </div>
@endsection