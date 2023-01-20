<div wire:ignore.self class="modal fade" id="ajustesinv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <label class="text-white text-sm">Operaciones en Inventarios</label>
                {{-- <button type="button" wire:click="resetajuste()" class="btn btn-sm btn-success text-center"> Cerrar </button> --}}
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="m-2">
                    <div class="row">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                     <tr>
                                        <th class="text-uppercase text-sm text-center" >Producto</th>
                                        <th class="text-uppercase text-sm ps-2">Existencia Actual</th>
                                        <th class="text-uppercase text-sm ps-2">Mobiliario Asignado</th>
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