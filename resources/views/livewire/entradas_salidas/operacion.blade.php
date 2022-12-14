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

                <div class="row">

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="d-flex">
                                Producto
                            </label>
                            @if ($result)
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <a class="input-group-text input-gp btn btn-warning" wire:click="deleteItem()">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                <input type="text" wire:model="result" placeholder="Buscar" class="form-control">
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
                        @if ($buscarproducto != 0)
                        <div class="col-sm-12 col-md-12">
                            <div class="vertical-scrollable">
                                <div class="row layout-spacing">
                                    <div class="col-md-12 ">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-content widget-content-area row">
                                                <div
                                                    class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="table table-hover table-sm" style="width:100%">
                                                        <thead class="text-white" style="background: #3B3F5C">
                                                            <tr>
                                                                <th class="table-th text-withe text-center">Producto
                                                                </th>
                                                                <th class="table-th text-withe">Acc.</th>
                                                            </tr>
                                                        </thead>
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
                            <input wire:model="costo" class="form-control">
                            @error('costo')
                            <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-1 ml-1 p-0">
                        <div class="form-group">
                            <label>
                                Agregar
                            </label>
                            <button type="button" wire:click="addProduct({{$selected}})"
                                class="btn btn-warning"> <i class="fas fa-arrow-down"></i> </button>
                        </div>


                    </div>
                </div>
          
                @endif

                <div class="row">
                    <div class="table-responsive">

                        @if (count($col)>0)
                        <center>

                            <table class="m-2">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">PRODUCTO</th>
                                        @if ($tipo_proceso != 'Salida')

                                        <th class="text-center">COSTO</th>
                                        @endif
                                        <th class="text-center">CANTIDAD</th>
                                        <th class="text-center">Acc.</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($col as $key=>$value)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            <h6>{{$value['product-name']}}</h6>
                                        </td>

                                        @if ($tipo_proceso != 'Salida')

                                        <td>
                                            <h6>{{$value['costo']}}</h6>
                                        </td>
                                        @endif

                                        <td>
                                            <h6>{{$value['cantidad']}}</h6>
                                        </td>
                                        <td>


                                            <a href="javascript:void(0)" wire:key="{{ $loop->index }}"
                                                wire:click="eliminaritem({{$value['product_id']}} )"
                                                class="btn btn-danger p-1" title="Quitar producto de la lista">
                                                <i class=" btn btn-sm fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>


                                    @endforeach
                                </tbody>
                            </table>
                        </center>
                        @endif

                    </div>
                </div>



                <div class="modal-footer">
                    <button type="button" wire:click="Exit()" class="btn btn-secondary close-btn"
                        data-bs-dismiss="modal">Cancelar</button>

                    <button type="button" wire:click="GuardarOperacion()"
                        class="btn btn-warning close-btn">Guardar</button>

                </div>

            </div>

        </div>
    </div>
</div>