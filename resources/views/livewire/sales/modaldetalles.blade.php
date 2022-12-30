<div wire:ignore.self class="modal fade" id="detalleventa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                <p class="text-sm mb-0">
                    Detalle de Venta Código: @if($this->venta != null) {{$this->venta->id}} @endif
                </p>
            </h1>
            <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            
        </div>
        <div class="modal-body">




            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                      <tr>                
                        <th class="text-uppercase text-sm text-center">Nº</th>
                        <th class="text-uppercase text-sm ps-2 text-left">Nombre</th>
                        <th class="text-uppercase text-sm ps-2 text-left">Precio (Bs)</th>
                        <th class="text-uppercase text-sm ps-2 text-left">Desc/Rec</th>
                        <th class="text-uppercase text-sm ps-2 text-left">Precio Venta</th>
                        <th class="text-uppercase text-sm ps-2 text-left">Cantidad</th>
                        <th class="text-uppercase text-sm ps-2 text-left">Total (Bs)</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($detalle_venta as $dv)
                        <tr class="text-left">
                            <td class="text-sm mb-0 text-center">
                                {{$loop->iteration}}
                            </td>
                            <td class="text-sm mb-0 text-left">
                                {{ ucwords(strtolower($dv->nombre)) }}
                            </td>
                            <td class="text-sm mb-0 text-left">
                                {{ number_format($dv->po, 2) }}
                            </td>



                            @if($dv->pv-$dv->po == 0)
                            <td class="text-sm mb-0 text-left">
                                {{ number_format($dv->pv-$dv->po, 2) }}
                            </td>
                            @else
                                @if($dv->pv-$dv->po < 0)
                                <td class="text-sm mb-0 text-left">
                                    <div style="color: rgb(250, 12, 12);">
                                        <p class="text-xs mb-0">
                                            Descuento
                                        </p>
                                    </div>
                                    {{ number_format($dv->pv-$dv->po, 2) }}
                                </td>
                                @else
                                <td class="text-sm mb-0 text-left">
                                    <div style="color: #002df3;">
                                        <p class="text-xs mb-0">
                                            Recargo
                                        </p>
                                    </div>
                                    {{ number_format($dv->pv-$dv->po, 2) }}
                                </td>
                                @endif
                            @endif


                            <td class="text-sm mb-0 text-left">
                                {{ number_format($dv->pv, 2) }}
                            </td>
                            <td class="text-sm mb-0 text-left">
                                {{ $dv->cantidad }}
                            </td>
                            <td class="text-sm mb-0 text-left">
                                {{ number_format($dv->pv * $dv->cantidad, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td class="text-center">
                            <p class="text-xs mb-0">
                                <b>-</b>
                            </p>
                        </td>
                        <td>
                            <p class="text-xs mb-0">
                                <b>-</b>
                            </p>
                        </td>
                        <td class="text-sm mb-0 text-left">
                            <b>Totales</b>
                        </td>
                        <td class="table-th text-withe text-right">
                            <p class="text-xs mb-0">
                                <b>--------</b>
                            </p>
                        </td>
                        <td class="table-th text-withe text-right">
                            <p class="text-xs mb-0">
                                <b>--------</b>
                            </p>
                        </td>
                        <td class="text-sm mb-0 text-left">
                            <b>{{$this->totalitems}}</b>
                        </td>
                        <td class="text-right align-middle">
                            @if($this->venta != null)
                            <p class="text-xs mb-0">
                                <b>{{number_format( $this->venta->total, 2) }}</b>
                            </p>
                            @endif
                        </td>
                      </tr>
                    </tfoot>
                  </table>
            
            
            
            
            </div>
            <div class="text-center" style="color: black">
                @if($this->desc_rec == 0)
                <div>
                    Esta Venta tuvo un Descuento Total de {{$this->desc_rec}} Bs
                </div>
                @else
                    @if($this->desc_rec < 0)
                    <div style="color: rgb(250, 12, 12);">Esta Venta tuvo un Descuento Total de<b> {{$this->desc_rec}} Bs</b></div>
                    @else
                    <div style="color: #002df3;">Esta Venta tuvo un Recargo Total de<b> {{$this->desc_rec}} Bs</b></div>
                    @endif
                @endif
                @if($this->venta != null)
                    @if($this->venta->observacion == "")
                    <b>Observación: Ninguna</b>
                    @else
                    <b>Observación: {{$this->venta->observacion}}</b>
                    @endif
                @endif
            </div>
            <br>
        </div>
    </div>
</div>