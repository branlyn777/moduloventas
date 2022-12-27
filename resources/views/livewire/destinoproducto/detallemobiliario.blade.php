<div wire:ignore.self class="modal fade" id="mobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" style="font-size: 16px">Ubicacion Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="cerrar()"></button>
            </div>
            <div class="modal-body">

                @if ($grouped)

                <div class="col-lg-12">

                    <div class="table-wrapper">

                        <div class="container">
                            @foreach ($grouped as $key=>$item)
                                <div class="media">
                                    <center>
                                        <label style="font-size: 16px">{{$key}}</label>
                                    </center>
                                    <div class="media-body">
                                        
                                        <div class="table-6">
                                            <table>
                                                <thead>
                                                    <tr class="text-center" style="font-size: 13px">
                                                        <th style="width: 100px;">ITEM</th>
                                                        <th style="width: 500px;">ESTANCIA</th>
                                                        <th style="width: 200px;">STOCK</th>
                                                        <th>MOBILIARIO</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="font-size: 12px">
                                                    @foreach ($item as $key=>$value)
                                                    <tr class="text-center">
    
                                                        <td>
                                                            <h6 class="text-center">{{ $loop->iteration}}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>{{$key}}</h6>
                                                        </td>
                                                        <td>
    
                                                            <h6>{{$value[0]->stock}}</h6>
                                                        </td>
                                                        <td>
    
                                                            @if ($value[0]->tipo == null)
                                                            <h6>No asignado</h6>
                                                            @else
                                                            @foreach ($value as $data)
    
                                                            <h6>{{$data->tipo}}-{{$data->mob_code}}</h6>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
    
                                                    @endforeach
                                                </tbody>
                                            </table>
    
                                        </div>
    
    
                                    </div>
                                </div>
                           
                            @endforeach
    
                        </div>
                    </div>



                </div>
                @endif
        
            </div>
        </div>
    </div>
</div>