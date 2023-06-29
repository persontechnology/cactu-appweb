@if ($carta->estado=='Respondida')
<span class="fw-semibold">Carta de {{ $carta->tipo }} ha sido {{ $carta->estado }}!</span>
<a href="{{ route('cartas-ninio.index',Crypt::encryptString($ninio->numero_child)) }}" class="btn btn-link">
    Regresar a mis cartas
</a>
@else

    <h1>Carta de {{ $carta->tipo }} {{ $edad }}</h1>
    <p><b>Asunto:</b>{{ $carta->asunto }}</p>
    <form action="{{ route('cartas-ninio.guardar-presentacion-mayor') }}" id="formCarta" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="imagen" value="{{ old('imagen') }}" id="inputImagen">
        <input type="hidden" name="foto_familia" value="{{ old('foto_familia') }}" id="foto_familia">
        <input type="hidden" name="id" value="{{ Crypt::encryptString($carta->id) }}">

        <div class="mb-2">
            <label for="hola">Hola</label>
            <input type="text" required name="hola" value="{{ old('hola') }}" id="hola" autofocus class="form-control input " placeholder="Ingresa el nombre de tu patrocinador">
        </div>
        
        <div class="mb-2">
            <label for="soy">Soy</label>
            <input type="text" required name="soy" value="{{ old('soy') }}" id="soy" class="form-control input " placeholder="Ingresa tu nombre">

        </div>
        <div class="mb-2">
            <label for="meDicen">y mis amigos me dicen</label>
            <input type="text" required name="meDicen" value="{{ old('meDicen') }}" id="meDicen" class="form-control input " placeholder="Como te dicen">

        </div>
        <div class="mb-2">
            <label for="edad">tengo</label>
            <input type="text" required name="edad" value="{{ old('edad') }}" id="edad" class="form-control input " placeholder="Ingresa tu edad Ejm: 11 años">

        </div>
        <div class="mb-2">
            <label for="miMejorAmigo">Mi mejor amigo se llama</label>
            <input type="text" required name="miMejorAmigo" value="{{ old('miMejorAmigo') }}" id="miMejorAmigo" class="form-control input " placeholder="Como se llama tu mejor amigo ">

        </div>
        <div class="mb-2">
            <label for="esMejorAmigo">es mi mejor amigo porque,</label>
            <textarea required name="esMejorAmigo" id="esMejorAmigo" rows="3" class="form-control textarea no-resize">{{ old('esMejorAmigo') }}</textarea>

        </div>
        <div class="mb-2">
            <label for="loquehago">Lo que maś me gusta hacer es,</label>
            <textarea required name="loquehago" id="loquehago" rows="3" class="form-control textarea no-resize">{{ old('loquehago') }}</textarea>

        </div>

        <div class="mb-2">
            <label for="miSueno">Cuando sea grande mi sueño es</label>
            <textarea type="text" required name="miSueno" id="miSueno" class="form-control textarea no-resize" rows="3">{{ old('miSueno') }}</textarea>


        </div>
        <div class="mb-2">
            <label for="dondeAprendo">El lugar donde aprendo es,</label>
            <textarea type="text" required name="dondeAprendo" id="dondeAprendo" class="form-control textarea no-resize" rows="3">{{ old('dondeAprendo') }}</textarea>

        </div>
        <div class="mb-2">
            <label for="gustaAprendes">lo que me gusta aprender es,</label>
            <textarea type="text" required name="gustaAprendes" id="gustaAprendes" class="form-control textarea no-resize " rows="3">{{ old('gustaAprendes') }}</textarea>

        </div>

        <div class="mb-2">
            <label for="mePaso">Lo más importante que me pasó últimamente es</label>
            <textarea type="text" required name="mePaso" id="mePaso" class="form-control textarea no-resize" rows="3">{{ old('mePaso') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="meGustaria">Lo que me gustaría aprender en el programa de ChildFund es</label>
            <textarea type="text" required name="meGustaria" id="meGustaria" class="form-control textarea no-resize" rows="3">{{ old('meGustaria') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="miFamilia">Esta es mi famila</label>
            <textarea type="text" required name="miFamilia" id="miFamilia" class="form-control textarea no-resize" rows="3">{{ old('miFamilia') }}</textarea>
        </div>
       
        <p>También quiero contarte del lugar donde vivo</p>
        <div class="mb-2">
            <label for="nuestraPro">Nuestra provincia se llama</label>
            <input type="text" required name="nuestraPro" value="{{ old('nuestraPro') }}" id="nuestraPro" class="form-control input ">

        </div>
        <div class="mb-2">
            <label for="idioma">y el idioma que hablamos es</label>
            <input type="text" required name="idioma" value="{{ old('idioma') }}" id="idioma" class="form-control input ">

        </div>
        <p>Donde nosotros vivimos hay sitios muy hermosos,</p>
        <div class="mb-2">
            <label for="lugarFavorito">mi lugar favorito es</label>
            <input type="text" required name="lugarFavorito" value="{{ old('lugarFavorito') }}" id="lugarFavorito" class="form-control input ">

        </div>
        <p>También tenemos comida típica, por ejemplo</p>
        <div class="mb-2">
            <label for="comidaTipica">La comida típica de esta región es</label>
            <textarea type="text" required name="comidaTipica" id="comidaTipica" class="form-control textarea no-resize" rows="3">{{ old('comidaTipica') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="comer">y a mi me gusta comer</label>
            <input type="text" required name="comer" value="{{ old('comer') }}" id="comer" class="form-control input ">
        </div>
        <div class="mb-2">
            <label for="masMeGusta">De nuestras tradiciones, lo que más me gusta es</label>
            <textarea type="text" required name="masMeGusta" id="masMeGusta" required class="form-control textarea no-resize" rows="3">{{ old('masMeGusta') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="pregunta">Me gustaría hacerte una pregunta</label>
            <textarea type="text" required name="pregunta" id="pregunta" class="form-control textarea no-resize" rows="3">{{ old('pregunta') }}</textarea>
        </div>
        <div class="mb-2">
            <label for="despedida">Cuéntale por qué quisieras que te conteste tu patrocinador, envíale un mensaje de despedida</label>
            <textarea type="text" required name="despedida" id="despedida" class="form-control textarea no-resize" rows="3">{{ old('despedida') }}</textarea>
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
        

        
        // $(".form-control").val('ola')
    </script>
    @endpush

@endif