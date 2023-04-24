<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modaldevolution" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white tex-sm" id="tabsModalLabel">MODAL DEVOLUCIONES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        @foreach ($listdestinations as $destino)
                            <td>{{ $destino->nom }}</td>
                        @endforeach
                    </div>


                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3"></div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <span class="text-sm tex-center">
                            <b> Seleccione Accion:</b>
                        </span>
                        <br>
                        <select class="form-select">
                            <option value="">Cambiar Producto</option>
                            <option value="">Devolver Dinero</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3"></div>
                </div>


                <div class="table-responsive">
                    <table class="table text-xs">
                        <thead>
                            <tr>
                                <th>Destino</th>
                                <th>Sucursal</th>
                                <th>Codigo</th>
                                <th>Cantidad</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listdestinations as $destino)
                                <tr>
                                    <td>
                                        <div wire:click='select_destination({{$desino->destino_id}})' style="background-color: aqua;">
                                            {{ $destino->destino }}
                                        </div>
                                    </td>
                                    <td>{{ $destino->sucursal }}</td>
                                    <td class="text-center">{{ $destino->co }}</td>
                                    <td class="text-center">{{ $destino->stock }}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <br>

                    {{-- <table class="table text-xs">
                        <thead>
                            <tr>
                           
                                <th>Sucursal</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($other_sucursals as $sucursal)
                            <td>{{ $sucursal->sucursal }}</td>
                        @endforeach

                        </tbody>
                    </table> --}}

                </div>
            </div>
        </div>
    </div>
</div>
