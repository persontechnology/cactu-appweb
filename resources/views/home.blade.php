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
                            <img class="rounded-circle" src="{{ asset('assets/images/logo_icon_azul.svg') }}" width="160" height="160" alt="">
                            
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <h6 class="mb-0">CACTU</h6>
                        <span class="text-muted">Corporación de Asociaciones de Cotopaxi y Tungurahua</span>
                        
                    </div>
                    <div class="text-center">
                        @auth
                            <div class="border-top text-center py-2 px-3">
                                <a href="{{ route('manual') }}" class="btn btn-yellow fw-semibold w-100 my-1">
                                    <i class="ph ph-monitor-play me-2"></i>
                                    Manual de usuario
                                </a>
                            </div>
                        @endauth
                    </div>
                   
                </div>
            </div>
        </form>
        
        <!-- /unlock form -->

    </div>
    <!-- /content area -->
@endsection
