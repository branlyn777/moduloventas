<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h6 class="mb-0">Almacen Producto</h6>  
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href='{{url('almacen/export/')}}' class="btn btn-outline-primary" > <i class="fas fa-arrow-alt-circle-up"></i> Exportar Excel</a>
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
                        <div class="btn-group ms-auto my-auto">
                        {{-- <div class="btn-group" role="group" aria-label="Basic mixed styles example"> --}}
                            <div class="p-2">
                                <select wire:model='selected_id' class="form-control">
                                    <option value="General">Almacen Total</option>
                                        @foreach ($data_suc as $data)
                                            <option value="{{ $data->id }}">{{ $data->sucursal }}-{{$data->destino}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="p-2">
                                <select wire:model='selected_mood' class="form-control">
                                    <option value="todos">TODOS</option>
                                    <option value='cero'>Productos agotados</option>
                                    <option value='bajo'>Productos bajo stock</option>
                                </select>
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
                    </div>

                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-container">
                                    <table class="table align-items-left mb-0">
                                        <thead>
                                            <tr style="font-size: 10.4px">
                                                <th>#</th>
                                                <th>IMAGEN</th>                              
                                                <th class="text-left" style="width: 15%" >PRODUCTO</th>                              
                                                <th>STOCK</th>
                                                <th>CANT.MIN</th>                                     
                                                <th>ACCIONES</th>                  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($destinos_almacen as $destino)
                                                @if ($destino->stock_s < $destino->cant_min)
                                            <tr style="font-size: 12px">
                                                @else
                                            <tr style="font-size: 12px">
                                            @endif
                                                    <td>
                                                        <h6 style="font-size: 12px">{{ $loop->iteration}}</h6>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <img src="{{('storage/productos/'.$destino->image) }}"
                                                                height="40" class="rounded">
                                                        </span> 
                                                    </td>
                                                    <td class="text-left" style="width: 15%">
                                                        <strong class="text-left" >{{$destino->nombre}}</strong>
                                                        <label class="text-left"  >{{ $destino->unidad}}</label>|<label>{{ $destino->marca}}</label>|<label>{{ $destino->industria }}</label>
                                                        {{ $destino->caracteristicas }}( <b>CODIGO:</b>  {{$destino->codigo}})
                                                    
                                                    </td>
                                                
                                                    @if ($selected_id == 'General')
                                                        <td>
                                                            {{ $destino->stock_s }}
                                                        </td>
                                                        <td>
                                                            {{ $destino->cantidad_minima }}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <a href="javascript:void(0)" wire:click="ver({{ $destino->id }})" class="mx-3">
                                                                <i class="fas fa-list"></i>
                                                            </a>

                                                            <a href="javascript:void(0)" wire:click="lotes({{ $destino->id }})" class="mx-3">
                                                                <i class="fas fa-box-open text-info"></i>
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <h6 class="text-center">{{ $destino->stock}}</h6>
                                                        </td>
                                                        <td>
                                                            {{ $destino->cantidad_minima }}
                                                        </td>
                                                        @can('Admin_Views')
                                                        <td>
                                                            <a href="javascript:void(0)" wire:click="ajuste({{ $destino->id }})" title="Ajuste de inventarios" class="mx-3">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        </td>
                                                        @endcan   
                                                    @endif
                
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> <br>
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