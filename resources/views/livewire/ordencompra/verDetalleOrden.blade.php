<div wire:ignore.self class="modal fade" id="detalleOrden" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" style="font-size: 14px" id="exampleModalCenterTitle">Detalle Orden de Compra </h5>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center" style="font-size: 13px">
                                            <th>N°</th>
                                            <th style="text-align: left">Nombre</th>
                                            <th>Precio (Bs)</th>
                                            <th>Cantidad</th>
                                            <th>Total (Bs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($ordendetalle != null)
                                            @foreach ($ordendetalle as $dc)
                                                <tr class="text-center" style="font-size: 12px">
                                                    <td>
                                                        {{$loop->index+1}}
                                                    </td>
                                                    <td style="text-align: left">
                                                        {{ $dc->productos->nombre}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{ number_format($dc->precio, 2) }}
                                                    </td>
                                            
                                                    <td>
                                                        {{ $dc->cantidad }}
                                                    </td>
                                                
                                                    <td class="text-right">
                                                        {{ number_format($dc->precio * $dc->cantidad,2)}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <p>nada</p>
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-size: 13px">
                                            <td>
                                            </td>

                                            <td>
                                                <b>
                                                    Totales
                                                </b>
                                            </td>
                                            <td class="table-th text-withe text-center">
                                                <b>
                                                    --------
                                                </b>
                                            </td>
                                    
                                            <td class="text-center">
                                                <b>
                                                    {{$totalitems}}
                                                </b>
                                            </td>
                                        
                                            <td class="text-center">
                                            
                                                <b>
                                                    {{number_format( $ordenTotal, 2) }}
                                                </b>
                                        
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center" style="color: black; font-size: 13px">
                <b>Observación: {{$observacion==null?'Ninguna observacion':$observacion}}</b>
            </div>
            <br>
        </div>
    </div>
</div>