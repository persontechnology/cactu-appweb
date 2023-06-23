@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('usuarios.index') }}
@endsection

@section('breadcrumb_elements')
<div class="d-lg-flex mb-2 mb-lg-0">
    <a href="{{ route('mis-ninios.create') }}" class="d-flex align-items-center text-body py-2">
        <i class="ph ph-file-plus"></i>Nuevo
    </a>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table datatable-basic" id="ninio">
                <thead>
                    <tr>
                        <th scope="col">Acción	</th>
                        <th scope="col">N° child</th>
                        <th scope="col">Nombres Completos</th>
                        <th scope="col">Género</th>
                        <th scope="col">Fecha Nacimiento</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Comunidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ninios as $ninio)
                        <tr>
                            <td>
                                @include('mis-ninios.action',['n'=>$ninio])
                            </td>
                            <td>{{ $ninio->numero_child }}</td>
                            <td>{{ $ninio->nombres_completos }}</td>
                            <td>{{ $ninio->genero }}</td>
                            <td>{{ $ninio->fecha_nacimiento }}</td>
                            <td>{{ $ninio->edad }}</td>
                            <td>{{ $ninio->comunidad->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@push('scripts')

   <script>
    $('#ninio').DataTable({
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: 100,
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    })
   </script>
@endpush

@endsection
