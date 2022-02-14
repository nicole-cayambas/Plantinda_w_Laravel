@extends('dashboard.layouts.app')
@section('dash_content')
@auth
<div class="m-0 sm:m-10">
    <h1>Good Day {{Auth()->user()->first_name}}!</h1>
</div>
@endauth
@endsection