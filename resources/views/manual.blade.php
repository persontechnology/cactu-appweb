@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('home') }}
@endsection

@section('content')
    <h1>MANUAL DE USUARIO</h1>
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{{ asset('img/manual.mp4') }}" allowfullscreen></iframe>
    </div>
@endsection
