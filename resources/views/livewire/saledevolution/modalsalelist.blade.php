<!-- Modal -->
<div wire:ignore.self class="modal fade" id="Modalsalelist" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white tex-sm" id="tabsModalLabel">Lista de Ventas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table text-xs">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Usuario</th>
                                <th>Cliente</th>
                                <th>Sucursal</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->salelist as $s)
                            @if ($s->verify == 0)
                            <tr>
                                
                            @else
                            <tr style="background-color: rgb(168, 178, 242) " title="Esta venta ya fue devuelto">
                            @endif

                            <td>
                                {{ $s->codigo }}
                            </td>
                            <td>
                                {{ $s->nombre_usuario }}
                            </td>
                            <td>
                                {{ $s->nombre_cliente }}
                            </td>
                            <td>
                                {{ $s->sucur }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($s->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="salelist/{{ $s->codigo }}"  target="_blank" class="btn btn-sm"><i class="fas fa-bars text-warning" aria-hidden="true"></i></a>
                      
                                <button wire:click='hidemodalsalelist({{$s->codigo}})' type="button" class="btn btn-sm"><i class="fas fa-plus text-warning" aria-hidden="true"></i></button>
                         
                              </div>
                             
                            </td>
                        </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
