@extends('layouts.app')

@section('breadcrumbs')

@endsection


@section('content')

<div class="card">
        
    <div class="card-body row">
        <div class="col-md-12 mb-1">
            <p>Subir el archivo excel en el siguente formato, debe incluir la primera fila de formato.</p>
            <div class="table-responsive my-2">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th scope="col">comunidad</th>
                            <th scope="col">numero_child</th>
                            <th scope="col">nombres_completos</th>
                            <th scope="col">genero</th>
                            <th scope="col">fecha_nacimiento</th>
                            <th scope="col">edad</th>
                            <th scope="col">email  </th>
                            <th scope="col">numero_celular  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td scope="row">Tisaleo Alto</td>
                            <td>153054940</td>
                            <td>Domenica Naome Guamanquise Tisalema</td>
                            <td>Female</td>
                            <td>3/7/2009</td>
                            <td>13</td>
                            <td>email@gmail.com <br><small class="bg-warning">(Esta columna no es requerido)</small></td>
                            <td>0998808775 <br><small class="bg-warning">(Esta columna no es requerido)</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="file-loading"> 
                <input type="file" name="foto" id="foto" class="file-input form-control @error('foto') is-invalid @enderror" accept=".xlsx, .xls">
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
           
        </div>
    </div>
</div>

@push('scriptsHeader')
{{-- fileinput --}}
<link href="{{ asset('assets/js/vendor/uploaders/fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/plugins/buffer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/plugins/filetype.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/js/locale/es.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploaders/fileinput/themes/fa6/theme.min.js') }}"></script>
@endpush

@push('scripts')
    <script>



    $("#foto").fileinput({
        
        uploadUrl: "{{ route('ninios.subir-importar') }}",
        allowedFileExtensions:["XLS","XLSX"],
        maxFileCount: 1,
        language: "es",
        theme: "fa6",
        browseLabel: 'Listado de ninios',
        showRemove: false,
        showClose: false,
    });

    </script>
@endpush
@endsection
