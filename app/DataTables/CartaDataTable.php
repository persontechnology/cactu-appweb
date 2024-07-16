<?php

namespace App\DataTables;

use App\Models\Carta;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;

class CartaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($c){
                return view('cartas.action',['c'=>$c])->render();
            })
            ->editColumn('numero_child',function($c){
                return $c->ninio->numero_child;
            })
            ->filterColumn('numero_child', function($query, $keyword) {
                $query->whereHas('ninio', function($query) use ($keyword) {
                    $query->whereRaw("numero_child like ?", ["%{$keyword}%"]);
                });
            })
            ->setRowClass('{{ $estado == "Enviado" ? "fw-bold" : "" }}')
           
            ->editColumn('ninio_id',function($c){
                return $c->ninio->nombres_completos;
                
            })
            ->editColumn('user_id',function($c){
                return $c->gestor->name;
            })
            ->editColumn('asunto',function($c){
                if($c->estado=='Enviado'){
                    return '<span class="badge bg-yellow text-black mx-2">'.$c->estado.'</span>'.$c->asunto;
                }else{
                    return '<span class="badge bg-success text-black mx-2">'.$c->estado.'</span>'.$c->asunto;
                }
            })
            ->editColumn('created_at',function($c){
                if($c->estado=='Enviado'){
                    return '<small>'.$c->created_at.'</small>';
                }else{
                    return '<small>'.$c->fecha_respondida.'</small>';
                }
            })
            ->rawColumns(['asunto','action','ninio_id','tipo','user_id','estado','created_at'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Carta $model): QueryBuilder
    {
        $user=Auth::user();
        if($user->hasRole('ADMINISTRADOR')){
            return $model->newQuery()->latest();
        }else{
            return $model->where('user_id',$user->id)->latest();
        }
        
        
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('carta-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::computed('numero_child')->title('Número Child')->searchable(true),
            Column::make('ninio_id')->title('Niño'),
            Column::make('asunto'),
            Column::make('tipo')->title('Tipo de carta'),
            // Column::make('estado'),
            Column::make('user_id')->title('Gestor'),
            Column::make('created_at')->title('Fecha'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Carta_' . date('YmdHis');
    }
}
