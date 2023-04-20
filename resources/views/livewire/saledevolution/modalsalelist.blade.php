<!-- Modal -->
<div wire:ignore.self class="modal fade" id="Modalsalelist" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white tex-sm" id="tabsModalLabel">Litsa de Ventas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              <th>Codigo</th>
                              <th>Usuario</th>
                              <th>Cliente</th>
                              <th>Sucursal</th>
                              <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($this->salelist as $s)
                          <tr>
                            <td>
                              {{ $s->id}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                              {{ \Carbon\Carbon::parse($s->created_at)->format('d/m/Y H:i') }}
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
