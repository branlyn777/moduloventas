<div wire:ignore.self class="modal fade" id="buscarproducto" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    @if ($detalle)
                                <div class="col-md-12 ">
                                 
                                    
                                            <div class="row justify-content-center">
                                                <h3>Detalle Operacion</h3>
                                            </div>
                                            <div class="row m-1">

                                                <div class="table-1">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-withe text-center">Producto</th>
                                                                <th class="text-withe">Cantidad</th>
                                                                <th class="text-withe">Costo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($detalle as $d)
                                                            <tr>
    
                                                                <td class="text-center">
                                                                    {{$loop->index+1}}
                                                                </td>
                                                                <td class="text-center">
                                                                    <h6 class="text-center">{{ $d->productos->nombre}}
                                                                    </h6>
                                                                </td>
                                                                <td class="text-center">
    
                                                                    {{$d->cantidad}}
                                                                </td>
                                                                <td class="text-center">
    
                                                                    {{$d->costo}}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                      
                                   
                                </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>