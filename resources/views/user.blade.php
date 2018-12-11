@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <user-list-component></user-list-component>
        <user-add-component></user-add-component>
        <user-delete-component></user-delete-component>
        <user-role-component></user-role-component>
    </div>
</div>
@endsection


@section( 'app' )
<!-- Scripts -->
<script src="{{ asset('js/user.js') }}"></script>
@endsection