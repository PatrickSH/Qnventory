@section('user_data',json_encode(session('user')))
@section('active_org',session("user")->active_org)