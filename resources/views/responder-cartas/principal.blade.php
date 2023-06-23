
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
	<!-- Global stylesheets -->
	<link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/icons/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('assets/demo/demo_configurator.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
	

	{{-- validate --}}
	<script src="{{ asset('assets/js/vendor/validate/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/validate/messages_es.min.js') }}"></script>
	

	{{-- jquery confirm --}}
	<link rel="stylesheet" href="{{ asset('assets/js/vendor/jquery-confirm/jquery-confirm.min.css') }}">
	<script src="{{ asset('assets/js/vendor/jquery-confirm/jquery-confirm.min.js') }}"></script>
	
	{{-- plugins extras --}}
	@stack('scriptsHeader')

	<script src="{{ asset('assets/js/app.js') }}"></script>
	
	<!-- /theme JS files -->
	{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
	
    
	<script>
		
		var block= $.dialog({
            title: '',
            content: 'Procesando solicitud. Por favor, espera.',
            type: 'blue',
            theme: 'modern',
            icon: 'fas fa-spinner fa-spin',
            typeAnimated: true,
            closeIcon: false,
			lazyOpen: true,
            
        });
		
		$.validator.setDefaults( {
			submitHandler: function(form) {
				block.open();
				form.submit();
			},
			errorElement: "strong",
			errorPlacement: function ( error, element ) {
				error.addClass( "invalid-feedback" );

				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertAfter( element.next( "label" ) );
				} else {
					error.insertAfter( element );
				}
			},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
			}
		} );

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>
</head>

<body class="bg-dark">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

                    <div class="container">
                        
                        <div class="card">
                            <div class="card-header">
                                <div class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center my-1">
                                        <img src="{{ asset('assets/images/logo_icon_azul.svg') }}" class="h-48px" alt="">
                                    </div>
                                    <p class="mb-0 fw-bold">{{ $ninio->genero==='Female'?'Bienvenida':'Bienvenido' }}, {{ $ninio->nombres_completos }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('sections.errors-alert')
                                @yield('content')
                            </div>
                            <div class="card-footer text-muted">
                                <span class="form-text text-center text-muted  ">
                                    © {{ date('Y') }} <a href="https://persontechnology.com/" target="_blank">Person Technology</a>. Todos los derechos reservados.
                                </span>
                            </div>
                        </div>
                        
                    </div>
					

				</div>
				<!-- /content area -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


	<!-- Demo config -->
	@include('sections.config')
	<!-- /demo config -->
    @stack('scripts')
</body>
</html>
