<div wire:ignore.self class="modal fade" id="verdetalle" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" style="font-size: 14px" id="exampleModalCenterTitle">Detalle de
                    Ajuste N°: {{ $ajuste }}</h5>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                @if ($tipo_de_operacion == 'Ajuste')

                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-center" style="font-size: 13px">
                                                <th>No</th>
                                                <th style="text-align: left">Producto</th>
                                                <th>Cantidad Original</th>
                                                <th>Recuento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($detalle != null)
                                                @foreach ($detalle as $dc)
                                                    <tr class="text-center" style="font-size: 12px">
                                                        <td class="text-center">
                                                            {{ $loop->index + 1 }}
                                                        </td>
                                                        <td style="text-align: left">
                                                            {{ $dc->productos->nombre }}
                                                        </td>
                                                        <td>
                                                            {{ $dc->tipo == 'positiva' ? $dc->recuentofisico - $dc->diferencia : $dc->recuentofisico + $dc->diferencia }}
                                                        </td>
                                                        <td>
                                                            {{ $dc->recuentofisico }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <p>nada</p>
                                            @endif

                                        </tbody>

                                    </table>
                                @elseif($op_selected == 'entrada' or $tipo_de_operacion=='Inicial')
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-center" style="font-size: 13px">
                                                <th>N°</th>
                                                <th style="text-align: left">Producto</th>
                                                <th>Cantidad</th>
                                                <th>Costo</th>
                                                <th>P/V</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($detalle != null)
                                                @foreach ($detalle as $dc)
                                                    <tr class="text-center" style="font-size: 12px">
                                                        <td class="text-center">
                                                            {{ $loop->index + 1 }}
                                                        </td>
                                                        <td style="text-align: left">
                                                            {{ $dc->productos->nombre }}
                                                        </td>
                                                        <td>
                                                            {{ $dc->cantidad }}
                                                        </td>
                                                        <td>
                                                            {{ $dc->costo }}
                                                        </td>
                                                        <td>
                                                            {{ $dc->pv }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <p>nada</p>
                                            @endif

                                        </tbody>

                                    </table>

                                @elseif($op_selected == 'salida')
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center" style="font-size: 13px">
                                            <th>N°</th>
                                            <th style="text-align: left">Producto</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($detalle != null)
                                            @foreach ($detalle as $dc)
                                                <tr class="text-center" style="font-size: 12px">
                                                    <td class="text-center">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td style="text-align: left">
                                                        {{ $dc->productos->nombre }}
                                                    </td>
                                                    <td>
                                                        {{ $dc->cantidad }}
                                                    </td>
                                                

                                                </tr>
                                            @endforeach
                                        @else
                                            <p>nada</p>
                                        @endif

                                    </tbody>

                                </table>


                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center" style="color: black; font-size: 13px">
                <b>Observación: {{ $observacion == null ? 'Ninguna observacion' : $observacion }}</b>
            </div>
            <br>
        </div>
    </div>
</div>