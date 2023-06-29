@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('comunidad.create') }}
@endsection



@section('content')
<form action="{{ route('comunidad.store') }}" method="POST" id="formUser" autocomplete="off">
    @csrf
    <div class="card">
       
        <div class="card-body row">
            <div class="fw-bold border-bottom pb-2 mb-3">COMPLETE DATOS</div>
            
            <div class="col-md-6 mb-1">
                <div class="form-floating form-control-feedback form-control-feedback-start">
                    <div class="form-control-feedback-icon">
                        <i class="ph ph-map-pin"></i>
                    </div>
                    <input name="nombre" value="{{ old('nombre') }}" type="text" class="form-control @error('nombre') is-invalid @enderror" required >
                    <label>Nombre de comunidad<i class="text-danger">*</i></label>
                    @error('nombre')
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
                    
                    <select name="usuario" class="form-select @error('usuario') is-invalid @enderror" required>
                        <option value=""></option>
                        @foreach ($usuarios as $user)
                            <option value="{{ $user->id }}" {{ old('usuario')==$user->id?'selected':'' }}>{{ $user->name }} {{ $user->email }}</option>
                        @endforeach
                    
                    </select>
                    <label>Seleccione usuario Gestor<i class="text-danger">*</i></label>
                    @error('usuario')
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
