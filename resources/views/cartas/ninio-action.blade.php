<button type="button" class="btn btn-primary" 
    data-id="{{ $n->id }}" 
    data-nombres_completos="{{ $n->nombres_completos }}" 
    data-bs-popup="tooltip" 
    title="Selecionar" 
    data-bs-placement="right" 
    onclick="selecionarNinio(this);"
>
    <i class="ph-hand-pointing"></i>
</button>