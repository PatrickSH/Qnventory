@extends('layouts.root')
@extends('layouts.logo')
@extends('layouts.security')
@extends('layouts.user_data')

@section('content')

    <div id="profile">
        <user-data></user-data>
    </div>

@endsection