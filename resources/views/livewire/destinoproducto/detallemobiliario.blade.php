<div wire:ignore.self class="modal fade" id="mobil" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="text-white">Ubicacion Producto</h5>
                <button type="button" class="close" data-keyboard="false" data-backdrop="static" data-dismiss="modal"
                    aria-label="Close" wire:click="cerrar()">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div>


                @if ($grouped)

                <div class="col-lg-12">

                    <div class="table-wrapper">

                        <div class="container">
                            @foreach ($grouped as $key=>$item)
                                <div class="media">
                                    <div class="media-body">
                                        <center>
                                            <h3>{{$key}}</h3>
                                        </center>
                                        <div class="table-6">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ITEM</th>
                                                        <th class="text-center">ESTANCIA</th>
                                                        <th class="text-center">STOCK</th>
                                                        <th class="text-center">MOBILIARIO</th>
    
    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item as $key=>$value)
                                                    <tr>
    
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