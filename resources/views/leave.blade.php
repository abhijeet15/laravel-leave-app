@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <leave-list-component></leave-list-component>
        <leave-add-component></leave-add-component>
        <leave-delete-component></leave-delete-component>
    </div>
</div>
@endsection


@section( 'app' )
<!-- Scripts -->
<script src="{{ asset('js/leave.js') }}"></script>
@endsection