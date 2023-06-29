<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end">
          @can('ver', $c)
            <a href="{{ route('cartas.show',$c->id) }}" class="dropdown-item">
                <i class="ph ph-eye me-2"></i>
                Ver
            </a>
          @endcan
            

        <a href="{{ route('cartas.documentos',$c->id) }}"  class="dropdown-item">
            <i class="ph ph-file-search me-2"></i>
            Documentos
        </a> 


            @can('eliminar', $c)
            <a href="{{ route('cartas.destroy',$c->id) }}" data-msg="Carta de {{ $c->tipo }} de {{ $c->ninio->nombres_completos }}" onclick="event.preventDefault(); eliminar(this)" class="dropdown-item">
                <i class="ph ph-trash me-2"></i>
                Eliminar
            </a>    
            @endcan
            
            
            
        </div>
    </div>
</div>