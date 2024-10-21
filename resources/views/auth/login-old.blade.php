@php
    $login = 1;
@endphp
@if ($login == 1)
    @extends('adminlte::auth.login')
@else
    @include('extranet.logins.login1')
@endif
