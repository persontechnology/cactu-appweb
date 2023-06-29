@if ($carta->estado=='Respondida')
<span class="fw-semibold">Carta de {{ $carta->tipo }} ha sido {{ $carta->estado }}!</span>
<a href="{{ route('cartas-ninio.index',Crypt::encryptString($ninio->numero_child)) }}" class="btn btn-link">
    Regresar a mis cartas
</a>
@else

    <h1>Carta de {{ $carta->tipo }} {{ $edad }}</h1>
    <p><b>Asunto:</b>{{ $carta->asunto }}</p>
    <form action="{{ route('cartas-ninio.guardar-presentacion-menor') }}" id="formCarta" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="imagen" value="{{ old('imagen') }}" id="inputImagen">
        <input type="hidden" name="foto_familia" value="{{ old('foto_familia') }}" id="foto_familia">
        <input type="hidden" name="id" value="{{ Crypt::encryptString($carta->id) }}">

        <div class="mb-2">
            <label for="hola">Hola</label>
            <input type="text" required name="hola" value="{{ old('hola') }}" id="hola" class="form-control input " placeholder="Ingresa el nombre a quién escribes">
        </div>
        <div class="mb-2">
            <label for="escribo">Escribo a nombre de</label>
            <input type="text" required name="escribo" value="{{ old('escribo') }}" id="escribo" class="form-control input " placeholder="Ingresa el nombre de quien representa">
        </div>
        <div class="mb-2">
            <label for="mi">mi</label>
            <input type="text" required name="mi" value="{{ old('mi') }}" id="mi" class="form-control input " placeholder="Ingresa el parentesco">
        </div>
        <div class="mb-2">
            <label for="queel">, que el </label>
            <input type="text" required name="queel" value="{{ old('queel') }}" id="queel" class="form-control input " placeholder="fecha">
        </div>
        <div class="mb-2">
            <label for="cumple">Cumple</label>
            <input type="text" required name="cumple" value="{{ old('cumple') }}" id="cumple" class="form-control input " placeholder="Cuantos años">
        </div>
        <div class="mb-2">
            <label for="noSabe">de edad y aún no sabe escribir pero</label>
            <textarea required name="noSabe" id="noSabe" rows="3" class="form-control input ">{{ old('noSabe') }}</textarea>
        </div>
    
        <div class="mb-2">
            <label for="ademas">Además a</label>
            <input type="text" required name="ademas" value="{{ old('ademas') }}" id="ademas" class="form-control input ">
        </div>
    
        <div class="mb-2">
            <label for="leGusta">le gusta</label>
            <textarea required name="leGusta" id="leGusta" rows="3" class="form-control input ">{{ old('leGusta') }}</textarea>
        </div>
    
        <div class="mb-2">
            <label for="dondeAprendo">El lugar  donde aprende es</label>
            <textarea type="text" required name="dondeAprendo" id="dondeAprendo" class="form-control input " rows="3">{{ old('dondeAprendo') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="gustaAprendes">En este  mes aprendimos</label>
            <textarea type="text" required name="gustaAprendes" id="gustaAprendes" class="form-control input " rows="3">{{ old('gustaAprendes') }}</textarea>
        </div>
        
        <div class="mb-2">
            <label for="mePaso">y lo más importante que nos pasó últimamente es</label>
            <textarea type="text" required name="mePaso" id="mePaso" class="form-control input " rows="3">{{ old('mePaso') }}</textarea>
        </div>
    
        <div class="mb-2">
            <label for="meGustaria">Lo que esperamos aprender con el programa de ChildFund es</label>
            <textarea type="text" required name="meGustaria" id="meGustaria" class="form-control input " rows="3">{{ old('meGustaria') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="miNombre">Mi nombre es</label>
            <input type="text" required name="miNombre" value="{{ old('miNombre') }}" id="miNombre" class="form-control input ">
        </div>
        <div class="mb-2">
            <label for="ysoy">y soy</label>
            <input type="text" required name="ysoy" value="{{ old('ysoy') }}" id="ysoy" class="form-control input ">
        </div>
        <div class="mb-2">
            <label for="de">de</label>
            <input type="text" required name="de" value="{{ old('de') }}" id="de" class="form-control input ">
        </div>
        <div class="md-2">
            <label for="mifamilia">Los otros miembros de nuestra familia son</label>
            <textarea type="text" required name="mifamila" id="mifamila" class="form-control input " rows="3">{{ old('mifamila') }}</textarea>
        </div>
    
        <div class="mb-2">
            <label for="nuestraPro">Nosotros vivimos  en la provincia de</label>
            <input type="text" required name="nuestraPro" value="{{ old('nuestraPro') }}" id="nuestraPro" class="form-control input ">
        </div>
        <div class="mb-2">
            <label for="idioma">y el idioma que hablamos es</label>
            <input type="text" required name="idioma" value="{{ old('idioma') }}" id="idioma" class="form-control input ">
        </div>
        
        <div class="mb-2">
            <label for="lugarFavorito">Nuestra provincia tiene sitios muy hermosos, a nosotros nos gusta ir a</label>
            <input type="text" required name="lugarFavorito" value="{{ old('lugarFavorito') }}" id="lugarFavorito" class="form-control input ">
        </div>
        
        <div class="mb-2">
            <label for="comidaTipica">También tenemos comida típica, por ejemplo</label>
            <textarea type="text" required name="comidaTipica" id="comidaTipica" class="form-control input " rows="3">{{ old('comidaTipica') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="ya">y a </label>
            <input type="text" required name="ya" value="{{ old('ya') }}" id="ya" class="form-control input ">
        </div>
        <div class="mb-2">
            <label for="comer">le gusta</label>
            <input type="text" required name="comer" value="{{ old('comer') }}" id="comer" class="form-control input ">
        </div>
        <div class="mb-2">
            <label for="masMeGusta">De nuestras tradiciones, la que compartimos juntos es</label>
            <textarea type="text" required name="masMeGusta" id="masMeGusta" class="form-control input " rows="3">{{ old('masMeGusta') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="pregunta">Nos gustaría saber más sobre ti y tu familia y hacerles una pregunta</label>
            <textarea type="text" required name="pregunta" id="pregunta" class="form-control input " rows="3">{{ old('pregunta') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="despedida">Cuéntale por qué quisieras que te conteste tu patrocinador, envíale un mensaje de despedida </label>
            <textarea type="text" required name="despedida" id="despedida" class="form-control input " rows="3">{{ old('despedida') }}</textarea>
        </div>

        <div class="col-md-12 mb1">
            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
                <div class="btn-group w-100 w-sm-auto">
                    <button type="button" class="btn btn-link flex-column" onclick="abrirModal(this)">
                        <div class="status-indicator-container">
                            <img id="imgId" src="{{ old('imagen',asset('assets/images/camara.png')) }}" class="w-32px h-32px rounded-pill" alt="">
                            <span class="status-indicator bg-success"></span>
                        </div>
                        Tomar foto personal
                    </button>

                    <button type="button" class="btn btn-link flex-column" onclick="abrirModalFamilia(this)">
                        <div class="status-indicator-container">
                            <img id="imgIdFamilia" src="{{ old('foto_familia',asset('assets/images/camara.png')) }}" class="w-32px h-32px rounded-pill" alt="">
                            <span class="status-indicator bg-success"></span>
                        </div>
                        Tomar foto con familia
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
              <h5 class="modal-title" id="staticBackdropLabel">Tomar foto personal</h5>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-4x3">
                    <video class="embed-responsive-item" id="videoId" autoplay="true"></video>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tomarFoto(this)" >TOMAR FOTO PERSONAL</button>
                <button type="button" class="btn btn-danger" onclick="cerrarModal(this);">CANCELAR</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropFamilia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel2">Tomar foto con familia</h5>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-4x3">
                    <video class="embed-responsive-item" id="videoIdFamilia" autoplay="true"></video>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tomarFotoFamilia(this)" >TOMAR FOTO</button>
                <button type="button" class="btn btn-danger" onclick="cerrarModalFamilia(this);">CANCELAR</button>
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

        let videoElementFamilia = document.getElementById('videoIdFamilia');
        let imgElementFamilia = document.getElementById('imgIdFamilia');
        var FACING_MODES_FAMILIA = JslibHtml5CameraPhoto.FACING_MODES;
        var cameraPhotoFamilia = new JslibHtml5CameraPhoto.default(videoElementFamilia);
        var estado_camara_familia=false;

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

        function startCameraFamilia(){
            cameraPhotoFamilia.startCamera(FACING_MODES_FAMILIA.ENVIRONMENT)
            .then(() => {
                console.log('Camera started !');
                estado_camara_familia=true;
            })
            .catch((error) => {
                alert('Encontramos un error con la camara del dispositivo.')
                console.error('Camera not started!', error);
            });
        }


        function abrirModal(){
            startCamera()
            
            if(estado_camara){
                $('#staticBackdrop').modal('show');
            }else{
                $('#staticBackdrop').modal('hide');
            }
        }

        function abrirModalFamilia(){
            startCameraFamilia()
            if(estado_camara_familia){
                $('#staticBackdropFamilia').modal('show');
            }else{
                $('#staticBackdropFamilia').modal('hide');
            }
        }
      

        function cerrarModal(arg){
            stopCamera()
            $('#staticBackdrop').modal('hide');
        }

        function cerrarModalFamilia(arg){
            stopCameraFamilia()
            $('#staticBackdropFamilia').modal('hide');
        }

        function tomarFoto(){
            takePhoto();
            stopCamera();
            $('#staticBackdrop').modal('hide');
        }

        function tomarFotoFamilia(){
            takePhotoFamilia();
            stopCameraFamilia();
            $('#staticBackdropFamilia').modal('hide');
        }

        // function called by the buttons.
        function takePhoto () {
            const config = {};
            let dataUri = cameraPhoto.getDataUri(config);
            imgElement.src = dataUri;
            var inputImagen = document.getElementById("inputImagen");
            inputImagen.value = dataUri;
        
        }

        function takePhotoFamilia () {
            const config = {};
            let dataUri = cameraPhotoFamilia.getDataUri(config);
            imgElementFamilia.src = dataUri;
            var inputImagen = document.getElementById("foto_familia");
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
        function stopCameraFamilia () {
            cameraPhotoFamilia.stopCamera()
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
        

        
        $(".form-control").val('ola')
    </script>
    @endpush

@endif