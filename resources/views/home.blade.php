@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('home') }}
@endsection

@section('content')
    <!-- Content area -->
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Unlock form -->
        <form class="login-form" action="index.html">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="rounded-circle" src="{{ asset('img/red-movil.png') }}" width="160" height="160" alt="">
                            
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <h6 class="mb-0">DESCARGAR APLICACIÓN MOVIL ANDROID</h6>
                        {{-- <span class="text-muted">Corporación de Asociaciones de Cotopaxi y Tungurahua</span> --}}
                        <a href="{{ asset('apk/cactu.apk') }}" class="btn btn-primary">DESCARGAR APK</a>
                    </div>
                </div>
            </div>
        </form>
        <!-- /unlock form -->

    </div>
    <!-- /content area -->
@endsection
