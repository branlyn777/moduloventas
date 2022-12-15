<div wire:ignore.self class="modal fade" id="operacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="text-white" id="exampleModalCenterTitle">Entrada/Salida de Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Seleccione un tipo de operacion:</label>

                        <select wire:model='tipo_proceso' class="form-control">
                            <option value="null" selected disabled>Elegir</option>
                            <option value="Entrada">Entrada</option>
                            <option value="Salida">Salida</option>
                        </select>
                        @error('tipo_proceso')
                        <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label style="color: rgb(74, 74, 74)">Seleccione la ubicacion:</label>
                        <select wire:model='destino' class="form-control">
                            <option value='Elegir' disabled>Elegir</option>
                            @foreach ($destinosp as $item)
                            <option value="{{$item->destino_id}}">{{$item->sucursal}}-{{$item->destino}}
                            </option>
                            @endforeach
                        </select>
                        @error('destino')
                        <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label style="color: rgb(74, 74, 74)">Seleccione el concepto:</label>
                        <select wire:model='concepto' class="form-control">
                            <option value="Elegir" disabled selected>Elegir</option>
                            @if ($tipo_proceso == 'Entrada')
                            <option wire:key="foo" value='INGRESO'>Operaciones Varias</option>
                            <option wire:key="bar" value="AJUSTE">Ajuste de inventarios
                            </option>
                            @else
                            <option wire:key="gj" value="SALIDA">Operaciones Varias</option>
                            <option wire:key="kl" value="AJUSTE">Ajuste de inventarios
                            </option>
                            @endif


                            @if ($tipo_proceso== 'Entrada')

                            <option value="INICIAL">Inventario Inicial</option>
                            @endif


                        </select>
                        @error('concepto')
                        <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>

                 
                    <div class="col-md-6">
                        <label style="color: rgb(74, 74, 74)">Tipo de registro</label>
                        <select wire:model='registro' class="form-control">
                            <option value="Manual" selected>Registrar Manualmente</option>
                            @if ($concepto == 'INICIAL')
                            <option value="Documento">Subir Archivo</option>
                            @endif
                        </select>

                    @if ($registro != 'Manual')
                        
                    <form wire:submit.prevent="import('{{$archivo}}')" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            
                            {{$archivo}}
                            <center>
                                <div wire:loading wire:target="archivo">
                                    <div class="d-flex align-items-center">
                                        <strong>Cargando Archivo, Espere por favor...</strong>
                                        <div class="spinner-border ms-auto"></div>
                                    </div>
                                </div>
                            </center>
                            
                        </div>
                        <input type="file" name="import_file" wire:model="archivo" />
                        
                        
                    </form>
                    @endif
                    </div>

                    <div class="col-md-6">
                        <label style="color: rgb(74, 74, 74)">Agregue una observacion:</label>


                        <textarea class="form-control" wire:model='observacion' cols="10" rows="3"></textarea>

                        @error('observacion')
                        <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                    



                </div>

                @if ($registro == 'Manual')

                <div class="row mt-4">

                    <div class="col-sm-12 col-md-6">
                        <div>

                            <div class="form-group">
                                <label>
                                    Producto
                                </label>
                                @if ($result)


                          



                                <div class="input-group">
                              
                                    
                                    <input type="text" wire:model="result" placeholder="Buscar" class="form-control">
                                    <button type="button" class="btn btn-warning" wire:click="deleteItem()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @error('result')
                                    <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>
                                @else
                                <input wire:model="searchproduct" class="form-control">
                                @error('result')
                                <span class="text-danger er">{{ $message }}</span>
                                @enderror
                                @endif
    
                            </div>
                        </div>
                        @if ($buscarproducto != 0)
                        <div class="col-sm-12 col-md-12">
                            <div class="vertical-scrollable">
                                <div class="row layout-spacing">
                                    <div class="col-md-12 ">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-content widget-content-area row">
                                                <div class="table-responsive">
                                                    <table class="table table-sm" style="width:100%">
                                                     
                                                        <tbody>
                                                            @foreach ($sm as $d)
                                                            <tr>
                                                                <td class="text-center">
                                                                    <h6 class="text-center">{{ $d->nombre }}
                                                                    </h6>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="javascript:void(0)"
                                                                        wire:click="Seleccionar('{{ $d->id }}')"
                                                                        class="btn btn-warning mtmobile"
                                                                        title="Seleccionar">
                                                                        <i class="fas fa-check"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-lg-2 ml-1 p-0">
                        <div class="form-group">
                            <label>
                                Cantidad
                            </label>
                            <input type="number" wire:model="cantidad" class="form-control">
                            @error('cantidad')
                            <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if ($tipo_proceso == 'Entrada')

                    <div class="col-lg-2 ml-1 p-0">
                        <div class="form-group">
                            <label>
                            Costo/Valor
                            </label>
                            <input wire:model="costo" class="form-control  mx-1">
                            @error('costo')
                            <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-2 ml-1 mt-3 pt-3">
                        <div class="form-group">
                            
                            <button type="button" wire:click="addProduct({{$selected}})" title="Agregar producto a la lista" 
                                class="btn btn-primary" style="width: 6rem" ><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
          
                @endif

                <div class="row">
                    @if (count($col)>0)
                    <div class="card-body p-4">
                            <div class="title">
                                <h6 class="text-center">Detalle Operacion</h6>
                            </div>
                        <div class="table-responsive">
                       
    
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Producto</th>
                                            @if ($tipo_proceso != 'Salida')
    
                                            <th class="text-center">Costo</th>
                                            @endif
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Acc.</th>
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($col as $key=>$value)
                                        <tr>
                                            <td class="text-center">
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                <h6>{{$value['product-name']}}</h6>
                                            </td>
    
                                            @if ($tipo_proceso != 'Salida')
    
                                            <td class="text-center">
                                                <h6>{{$value['costo']}}</h6>
                                            </td>
                                            @endif
    
                                            <td class="text-center">
                                                <h6>{{$value['cantidad']}}</h6>
                                            </td>
                                            <td class="text-center">
    
    
                                                <a type="button" wire:key="{{ $loop->index }}"
                                                    wire:click="eliminaritem({{$value['product_id']}})"
                                                    class="mx-3" title="Quitar producto de la lista">
                                                    <i class="fas fa-times text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
    
    
                                        @endforeach
                                    </tbody>
                                </table>
                            
                                
                            </div>
                        </div>
                        @endif
                </div>



                <div class="modal-footer">
                    <button type="button" wire:click="Exit()" class="btn btn-secondary close-btn"
                        data-bs-dismiss="modal">Cancelar</button>

                    <button type="button" wire:click="GuardarOperacion()"
                        class="btn btn-primary close-btn">Guardar</button>

                </div>

            </div>

        </div>
    </div>
</div>