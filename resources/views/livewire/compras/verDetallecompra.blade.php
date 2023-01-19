<div wire:ignore.self class="modal fade" id="detalleCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" style="font-size: 14px" id="exampleModalCenterTitle">Detalle de Compra Código: </h5>
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
                                            <th>No</th>
                                            <th style="text-align: left">Nombre</th>
                                            <th>Precio (Bs)</th>
                                            <th>IVA%</th>
                                            <th>Cantidad</th>
                                            <th>Total (Bs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($detalleCompra != null)
                                            @foreach ($detalleCompra as $dc)
                                                <tr class="text-center" style="font-size: 12px">
                                                    <td class="text-center">
                                                        {{$loop->index+1}}
                                                    </td>
                                                    <td style="text-align: left">
                                                        {{ $dc->productos->nombre}}
                                                    </td>
                                                    <td >
                                                        {{ number_format($dc->precio, 2) }}
                                                    </td>
                                                    @if ($dc->compra->tipo_doc == 'FACTURA')
                                                        <td>
                                                            {{ number_format(($dc->precio/0.87)*0.13*$dc->cantidad, 2) }}
                                                        </td>
                                                    @else
                                                        <td>
                                                            {{ number_format(0, 2) }}
                                                        </td>
                                                    @endif
                                                        <td class="text-center">
                                                            {{ $dc->cantidad }}
                                                        </td>
                                                    @if ($dc->compra->tipo_doc == 'FACTURA')
                                                        <td>
                                                            {{ number_format(($dc->precio * $dc->cantidad)/0.87, 2) }}
                                                        </td>
                                                    @else
                                                        <td>
                                                            {{ number_format($dc->precio * $dc->cantidad,2)}}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <p>nada</p>
                                        @endif
                                    
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-size: 13px">
                                            <td class="text-center">
                                            </td>

                                            <td>
                                                <b>
                                                    Totales
                                                </b>
                                            </td>
                                            <td class="text-center">
                                                <b>
                                                    --------
                                                </b>
                                            </td>

                                            @if ($totalIva != null)
                                                <td class="table-th text-withe text-right">
                                                    <b>
                                                        {{number_format($totalIva,2)}}
                                                    </b>
                                                </td>
                                            @else
                                                
                                                <td class="text-center">
                                                    <b>
                                                        {{ number_format(0, 2) }}
                                                    </b>
                                                </td>
                                            @endif
                                            <td class="text-center">
                                                <b>
                                                    {{$totalitems}}
                                                </b>
                                            </td>
                                        
                                            <td  class="text-center">
                                            
                                                <b>
                                                    {{number_format( $compraTotal, 2) }}
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