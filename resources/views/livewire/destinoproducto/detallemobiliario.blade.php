<div wire:ignore.self class="modal fade" id="mobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" style="font-size: 14px">Ubicacion Producto</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="cerrar()"></button> --}}
                <button type="button" class="btn-close fs-3"  wire:click="cerrar()"  data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @if ($grouped)

                <div class="col-lg-12">

               

                    @foreach ($grouped as $key=>$item)
                    <div class="card p-1 bg-success">
                        
                        <div class="card-body">
                            <h4 style="font-size: 14px">{{$key}}</h4>
                             
                              
                                        
                                        <div class="table-6">
                                            <table>
                                                <thead>
                                                    <tr style="font-size: 14px">
                                                        <th class="text-center" style="width: 100px;">N°</th>
                                                        <th style="width: 500px;">ALMACEN</th>
                                                        <th style="width: 200px;">CANTIDAD</th>
                                                        <th>MOBILIARIO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item as $key=>$value)
                                                    <tr style="font-size: 14px">
                                                        <td class="text-center">
                                                            {{ $loop->iteration}}
                                                        </td>
                                                        <td>
                                                            {{$key}}
                                                        </td>
                                                        <td>
                                                            {{$value[0]->stock}}
                                                        </td>
                                                        <td>
                                                            @if ($value[0]->tipo == null)
                                                                No asignado
                                                            @else
                                                                @foreach ($value as $data)
                                                                    <h6>{{$data->tipo}}-{{$data->mob_code}}</h6>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
    
                                                    @endforeach
                                                
                                                </tbody>
                                            </table><br>
    
                                        </div>
    
    
                                </div>
                           
                            </div>
                            @endforeach
    
               



                </div>
                @endif
        
            </div>
        </div>
    </div>
</div>