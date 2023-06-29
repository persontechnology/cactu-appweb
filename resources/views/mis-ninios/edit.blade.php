@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('mis-ninios.edit',$ninio) }}
@endsection



@section('content')
<form action="{{ route('mis-ninios.update',$ninio) }}" method="POST" id="formUser" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="card">
       
        <div class="card-body row">
            <div class="fw-bold border-bottom pb-2 mb-3">COMPLETE DATOS</div>
            

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph ph-list-numbers"></i>
                    </div>
                    <input name="numero_child" value="{{ old('numero_child',$ninio->numero_child) }}" type="number" class="form-control @error('numero_child') is-invalid @enderror" required autofocus >
                    <label>Número child<i class="text-danger">*</i></label>
                    @error('numero_child')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user-list"></i>
                    </div>
                    <input name="nombres_completos" value="{{ old('nombres_completos',$ninio->nombres_completos) }}" type="text" class="form-control @error('nombres_completos') is-invalid @enderror" required >
                    <label>Nombres completos<i class="text-danger">*</i></label>
                    @error('nombres_completos')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-user-switch"></i>
                    </div>
                    <select class="form-select @error('genero') is-invalid @enderror" name="genero" required>
                        <option value=""></option>
                        <option value="Male" {{ old('genero',$ninio->genero)=='Male'?'selected':'' }}>Male</option>
                        <option value="Female" {{ old('genero',$ninio->genero)=='Female'?'selected':'' }}>Female</option>
                    </select>
                    <label>Género<i class="text-danger">*</i></label>
                    @error('genero')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph-calendar"></i>
                    </div>
                    <input name="fecha_nacimiento" value="{{ old('fecha_nacimiento',$ninio->fecha_nacimiento) }}" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required>
                    <label>Fecha de nacimiento<i class="text-danger">*</i></label>
                    @error('fecha_nacimiento')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-12 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph ph-map-pin"></i>
                    </div>
                    
                    <select name="comunidad" class="form-select @error('comunidad') is-invalid @enderror" required>
                        <option value=""></option>
                        @foreach ($comunidades as $comunidad)
                            <option value="{{ $comunidad->id }}" {{ old('comunidad',$ninio->comunidad_id)==$comunidad->id?'selected':'' }}>{{ $comunidad->nombre }}</option>
                        @endforeach
                    
                    </select>
                    <label>Seleccione comunidad<i class="text-danger">*</i></label>
                    @error('comunidad')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
          
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph ph-envelope"></i>
                    </div>
                    <input name="email" value="{{ old('email',$ninio->email) }}" type="email" class="form-control @error('email') is-invalid @enderror" >
                    <label>Email</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph ph-device-mobile"></i>
                    </div>
                    <input name="numero_celular" value="{{ old('numero_celular',$ninio->numero_celular) }}" type="text" class="form-control @error('numero_celular') is-invalid @enderror" >
                    <label>Número celular</label>
                    @error('numero_celular')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
           
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>



@push('scripts')
    <script>
   
        $('#formUser').validate();
         
    </script>
@endpush
@endsection
