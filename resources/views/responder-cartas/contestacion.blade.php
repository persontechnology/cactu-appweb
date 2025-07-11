@if ($carta->estado=='Respondida')
<span class="fw-semibold">Carta de {{ $carta->tipo }} ha sido {{ $carta->estado }}!</span>
<a href="{{ route('cartas-ninio.index',Crypt::encryptString($ninio->numero_child)) }}" class="btn btn-link">
    Regresar a mis cartas
</a>
@else
    <h1>Carta de {{ $carta->tipo }}</h1>
    @if ($carta->archivo_pdf)
        <h3>DE PARTE DE TU PATROCINADOR</h3>
        <div class="ratio ratio-16x9 my-2">
            <iframe src="{{ route('cartas-ninio.ver-archivo',[Crypt::encryptString($carta->id),'pdf']) }}" title="{{ $carta->tipo }}" allowfullscreen></iframe>
        </div> 
    @endif

    <hr>
    <p><b>Asunto:</b>{{ $carta->asunto }}</p>
    <p><strong>Hola,</strong> {{ $carta->ninio->nombres_completos }}</p>

    <form action="{{ route('cartas-ninio.guardar-contestacion') }}" id="formCarta" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="imagen" id="inputImagen">
        <input type="hidden" name="id" value="{{ Crypt::encryptString($carta->id) }}">
        
        <div class="mb-2">
            <label for="nombre_patrocinador">Ingresa el nombre de tu patrocinador</label>
            <input type="text" required name="nombre_patrocinador" value="{{ old('nombre_patrocinador') }}" id="nombre_patrocinador" class="form-control input " placeholder="Ingresa el nombre de tu patrocinador." required>
        </div>

        <div class="mb-2">
            <label for="agradezco_por">Agradesco por la</label>
            <input type="text" required name="agradezco_por" value="{{ old('agradezco_por') }}" id="agradezco_por" class="form-control input " placeholder="Libreta, carta, tarjeta" required>
        </div>

        <div class="mb-2">
            <label for="te_cuento_que">Te cuento que </label>
            <input type="text" required name="te_cuento_que" value="{{ old('te_cuento_que') }}" id="te_cuento_que" class="form-control input " placeholder="...." required>
        </div>
        <div class="mb-2">
            <label for="pregunta_al_patrocinador">Es hora de hacer una pregunta a tu patrocinador</label>
            <input type="text" required name="pregunta_al_patrocinador" value="{{ old('pregunta_al_patrocinador') }}" id="pregunta_al_patrocinador" class="form-control input " placeholder="...." required>
        </div>
        
        <label for="detalle">Aquí tu despedida, no te olvides de poner  tu nombre </label>
        <div class="col-md-12 mb-1">
            <div class="form-floating form-control-feedback form-control-feedback-start">
                <div class="form-control-feedback-icon">
                    <i class="ph ph-article-medium"></i>
                </div>
                <textarea name="detalle" id="detalle" style="height: 250px" class="form-control @error('detalle') is-invalid @enderror" required>{{ old('detalle') }}</textarea>
                <label for="detalle">Redacte aquí....</label>
                @error('detalle')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-12 mb1">
            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
                <div class="btn-group w-100 w-sm-auto">
                    <button type="button" class="btn btn-link flex-column" onclick="abrirModal(this)">
                        <div class="status-indicator-container">
                            <img id="imgId" src="{{ asset('assets/images/camara.png') }}" class="w-32px h-32px rounded-pill" alt="">
                            <span class="status-indicator bg-success"></span>
                        </div>
                        Tomar foto
                    </button>
                   
                </div>

                <div class="hstack gap-2 mt-3 mt-sm-0">
                    <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                        Responder
                    </button>
                    <a href="{{ route('cartas-ninio.index',Crypt::encryptString($ninio->numero_child)) }}" class="btn btn-danger w-100 w-sm-auto">
                        Cancelar
                    </a>
                </div>
                
            </div>
        </div>


        
    </form>
            
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Tomar foto</h5>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-4x3">
                    <video class="embed-responsive-item" id="videoId" autoplay="true"></video>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tomarFoto(this)" >TOMAR FOTO</button>
                <button type="button" class="btn btn-danger" onclick="cerrarModal(this);">CANCELAR</button>
            </div>
          </div>
        </div>
    </div>

    @push('scriptsHeader')
    <script src="{{ asset('assets/js/jslib-html5-camera-photo.min.js') }}"></script>
    @endpush
    @push('scripts')


    <script>
        

        let videoElement = document.getElementById('videoId');
        let imgElement = document.getElementById('imgId');
        
        var FACING_MODES = JslibHtml5CameraPhoto.FACING_MODES;
        var cameraPhoto = new JslibHtml5CameraPhoto.default(videoElement);
        var estado_camara=false;

        function startCamera(){
            
            cameraPhoto.startCamera(FACING_MODES.ENVIRONMENT)
            .then(() => {
                console.log('Camera started !');
                estado_camara=true;
            })
            .catch((error) => {
                alert('Encontramos un error con la camara del dispositivo.')
                console.error('Camera not started!', error);
                
            });
        }

        function abrirModal(){
            startCamera();
            if(estado_camara){
                $('#staticBackdrop').modal('show');
            }else{
                $('#staticBackdrop').modal('hide');
            }
            
        }

        function cerrarModal(arg){
            stopCamera()
            $('#staticBackdrop').modal('hide');
        }

        function tomarFoto(){
            takePhoto();
            stopCamera();
            $('#staticBackdrop').modal('hide');
        }

        // function called by the buttons.
        function takePhoto () {
            const config = {};
            let dataUri = cameraPhoto.getDataUri(config);
            imgElement.src = dataUri;
            var inputImagen = document.getElementById("inputImagen");
            inputImagen.value = dataUri;
        
        }

        function stopCamera () {
            cameraPhoto.stopCamera()
            .then(() => {
                console.log('Camera stoped!');
            })
            .catch((error) => {
                console.log('No camera to stop!:', error);
            });
        }


        $('#formCarta').validate({
            
            submitHandler: function(form) {
                
                $.confirm({
                    title: 'CONFIRMAR',
                    content: "Esta seguro de responder carta de {{ $carta->tipo }}.",
                    type: 'blue',
                    theme: 'modern',
                    icon: 'fa fa-triangle-exclamation',
                    typeAnimated: true,
                    escapeKey: 'NO',
                    buttons: {
                        SI: {
                            btnClass: 'btn btn-primary',
                            keys: ['enter'],
                            action: function(){
                                
                                
                                block.open()
                                form.submit()
                            }
                        },
                        NO: function () {
                            
                        }
                    }
                });
            }
        });
        
    </script>
    @endpush

@endif