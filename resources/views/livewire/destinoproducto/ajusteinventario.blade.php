<div wire:ignore.self class="modal fade" id="ajustesinv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Operaciones en Inventarios</h5>
                {{-- <button type="button" wire:click="resetajuste()" class="btn btn-sm btn-success text-center"> Cerrar </button> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetajuste()"></button>
            </div>

            <div class="modal-body">
                <div class="m-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-sm table-bordered">
                                <thead>
                                     <tr class="text-center" style="font-size: 13px">
                                        <th>Producto</th>
                                        <th>Existencia Actual</th>
                                        <th>Mobiliario Asignado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center" style="font-size: 11px">
                                        <td class="text-center p-0 m-0" >
                                            {{$productoajuste}}
                                        </td>
                                        <td class="text-center">
                                            {{$productstock}}
                                        </td>
                                        <td class="text-center">
                                            @if ($mop_prod)
                                            @foreach ($mop_prod as $item)
                                            <div class="btn-group">
                                                <span class="text-center pt-2">{{$item->locations->tipo}} {{$item->locations->codigo}}</span>
                                            <i class=" btn btn-sm fas fa-trash" wire:click="eliminarmob({{$item->id}} )"></i>
                                            </div>
                                            @endforeach
                                                @else
                                                <label>Sin mobiliarios</label>
                                                @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>            
                </div>

                <div class="m-2" style="font-size: 13px">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                
                            <a class="nav-link active show" wire:click="$set('toogle', '1')" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab">Ajuste de Inventarios</a>
                
                            <a class="nav-link" wire:click="$set('toogle', '2')" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab">Entradas y Salida de Productos</a>
                            <a class="nav-link" wire:click="$set('toogle', '3')" id="nav-mobiliario-tab" data-toggle="tab" href="#nav-mobiliario" role="tab">Asignar Mobiliario</a>
                        </div>
                    </nav>
                    <div class="tab-content  text-center" id="nav-tabContent">
                        <div class="tab-pane fade {{$active1}}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                
                            {{-- <div class="m-2">
                                <ul class="row justify-content-start">
                                    <button class="btn btn-sm btn-dark" wire:click='vaciarProducto()'>Vaciar Stock </button>  
                                </ul>
                            </div> --}}
                            
                            <div class="row m-2">
                                <div class="col-lg-6 ">
                                
                                    <label class="text"> <strong>Existencia Actual</strong></label>
                            
                                    <h2> {{$productstock}}</h2>
                        
                                </div>
                                <div class="col-lg-6">
                                
                                    <label class="text"> <strong>Nueva Existencia</strong> </label>
                            
                                    <input type="text" class="form-control"  wire:model="cantidad"  aria-label="Recipient's username with two button addons">
                                    @error('cantidad') <span class="text-danger er">{{ $message }}</span>@enderror
                                    
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn bg-gradient-primary btn-sm mb-0" wire:click='aplicarCambios()'>Aplicar Cambios</button>
                            </div>
                            <div><br></div>
                        </div>

                        <div class="tab-pane fade {{$active2}}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row  m-2">
                                <div class="col-lg-12">

                                    <div class="input-group">
                                        {{-- <label class="btn btn-outline-secondary ml-0 mr-0" for="inputGroupSelect01">Tipo Operacion</label> --}}
                                        <a class="btn btn-outline-secondary ml-0 mr-0 col-lg-5" for="inputGroupSelect01">Tipo Operacion</a>
                                        <select class="form-select col-lg-8" wire:model="opcion_operacion" id="inputGroupSelect01">
                                            <option selected>Elegir un tipo de operacion</option>
                                            <option value="Entrada">Entrada de Producto</option>
                                            <option value="Salida">Salida de Producto</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <br>
                                    <div class="row  text-center">
                                        <div class="col-lg-4 form-group">
                                            <label class="text mb-1">Asignar Cantidad:</label>
                                            <input type="text" class="form-control" wire:model="cant_operacion">
                                             
                                        </div>
                                        <div class="col-lg-8 form-group">
                                            <label for="exampleFormControlTextarea1">Agregue una Observacion:</label>
                                            <input class="form-control" wire:model="obs_operacion" id="exampleFormControlTextarea1">
                                        </div>
                                    </div>
                                      
                                </div>
                                <div class="text-center">
                                    <button class="btn bg-gradient-primary btn-sm mb-0"  wire:click='operacionInventario()' >Guardar Registro</button>
                                </div> 
                            </div>
                        </div>

                        <div class="tab-pane fade {{$active3}}" id="nav-mobiliario" role="tabpanel" aria-labelledby="nav-mobiliario-tab">
                            <div class="row m-2">
                                <div class="col-lg-12">
                                   
                                    <div class="col-lg-4">
                                        <label> Mobiliarios:</label>
                                        <select class="form-select" wire:model='mobiliario' id="inputGroupSelect04" aria-label="Example select with button addon">
                                            @if ($mobs)
                                                    <option value=null disabled selected>Elegir Mobiliario</option>
                                                @foreach ($mobs as $data)
                                                    <option value="{{ $data->id }}">{{ $data->tipo}}-{{$data->codigo}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    
                                </div>
                                <br><br><br><br>
                                <div>
                                    <button class="btn bg-gradient-primary btn-sm mb-0" wire:click='asignmob()' type="button">Asignar Mobiliario</button>
                                </div>
                                
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>