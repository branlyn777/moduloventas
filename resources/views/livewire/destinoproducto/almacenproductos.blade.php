<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Almacen Producto</h5>  
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                              
                                <a href='{{url('almacen/export/')}}' class="btn btn-outline-primary" > <i class="fas fa-arrow-alt-circle-up"></i>Exportar Excel</a>
                                   
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-lg-flex">
                        
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="input-group">
                                <span class="input-group-text input-gp">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
                            </div>
                        </div>

                        {{--SELECT DE LAS SUCURSALES--}}
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <select wire:model='selected_id' class="form-control" style="align-items: flex-end">
                                    <option value="General">Almacen Total</option>
                                        @foreach ($data_suc as $data)
                                            <option value="{{ $data->id }}">{{ $data->sucursal }}-{{$data->destino}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <select wire:model='selected_mood' class="form-control">
                                    <option value="todos">TODOS</option>
                                    <option value='cero'>Productos agotados</option>
                                    <option value='bajo'>Productos bajo stock</option>
                                </select>
                            </div>
                        </div>
                        
                        {{-- <div class="form-group">
                            <select wire:model='filtro_stock' class="form-control">
                                <option value="TODOS">Todos</option>
                                <option value="BAJO_STOCK">Productos con bajo stock</option> --}}
                                {{-- <option value="AGOTADOS">Productos agotados</option> --}}
                                {{-- <option value="BAJA ROTACION">Listar productos con baja rotacion</option>
                                <option value="ALTA DEMANDA">Listar productos de alta demanda</option> --}}
                            {{-- </select> --}}
                        {{-- </div> --}}
                        {{-- @if ($selected_id != 'General')
                        <div class="form-group">
                        <button type="button" class="btn btn-danger" onclick="Confirmarvaciado()">Vaciar Almacen</button>
                         </div>
                       
                        @endif --}}

                    </div>

                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-container">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>IMAGEN</th>                              
                                                <th>PRODUCTO</th>                              
                                                <th>STOCK</th>
                                                <th>CANT.MIN</th>                                       
                                                <th>ACCIONES</th>                  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($destinos_almacen as $destino)
                                                @if ($destino->stock_s < $destino->cant_min)
                                            <tr class="seleccionar">
                                                @else
                                            <tr class="seleccionar">
                                            @endif
                                                    <td>
                                                        <h6 class="text-center">{{ $loop->iteration}}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <span>
                                                            <img src="{{('storage/productos/'.$destino->image) }}"
                                                                height="40" class="rounded">
                                                        </span> 
                                                    </td>
                                                    <td>
                                                        <strong>{{$destino->nombre}}</strong>
                                                        <label>{{ $destino->unidad}}</label>|<label>{{ $destino->marca}}</label>|<label>{{ $destino->industria }}</label>
                                                        {{ $destino->caracteristicas }}( <b>CODIGO:</b>  {{$destino->codigo}})
                                                    
                                                    </td>
                                                
                                                    @if ($selected_id == 'General')
                                                    <td>
                                                        <center>{{ $destino->stock_s }}</center> 
                                                    </td>
                                                    <td>
                                                        <center>{{ $destino->cantidad_minima }}</center> 
                                                    </td>
                                                <td>
                                                    <center>

                                                        <button wire:click="ver({{ $destino->id }})" type="button" class="btn btn-secondary p-1" style="background-color: rgb(16, 80, 150)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                                        </button>
                                                        <button wire:click="lotes({{ $destino->id }})" type="button" class="btn btn-dark p-1" style="background-color: rgb(12, 100, 194)">
                                                                <i class="fas fa-box-open" ></i>
                                                        </button>
                                                    </center>
                                                
                                                </td>
                                                    @else
                                                    <td>
                                                        <h6 class="text-center">{{ $destino->stock}}</h6>
                                                    </td>
                                                    <td>
                                                        <center>{{ $destino->cantidad_minima }}</center> 
                                                    </td>
                                                    @can('Admin_Views')
                                                    <td>
                                                    <button  wire:click="ajuste({{ $destino->id }})" class="btn btn-success p-1" title="Ajuste de inventarios" style="background-color: rgb(13, 175, 220); color:white">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                    </td>
                                                    @endcan   
                                                    @endif
                
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{$destinos_almacen->links() }}
                </div>
            </div>          
        </div>    
    </div>
    @include('livewire.destinoproducto.detallemobiliario')
    @include('livewire.destinoproducto.ajusteinventario')
    @include('livewire.destinoproducto.lotesproductos')
</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modal', msg => {
            $('#mobil').modal({backdrop: 'static', keyboard: false})
            $('#mobil').modal('show')
           
        });
        window.livewire.on('show-modal-ajuste', msg => {
            $('#ajustesinv').modal('show')
        });  
        window.livewire.on('show-modal-lotes', msg => {
            $('#lotes').modal('show')
        });  
        window.livewire.on('hide-modal-ajuste', msg => {
            $('#ajustesinv').modal('hide')
        });  
       
    });

    function Confirmarvaciado() {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Esta seguro de vaciar el stock del almacen ?',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('vaciarDestino')
                Swal.close()
            }
        })
    }


</script>

@endsection