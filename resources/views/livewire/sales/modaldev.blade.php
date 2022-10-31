<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modaldevolucion" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="tabsModalLabel">Nueva Devolución</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text input-gp">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="text" wire:model="buscarventa" placeholder="Buscar por Codigo de Venta" class="form-control">
            </div>


            <div class="table-1">
                <table>
                    <thead>
                        <tr class="text-center">
                            <th>
                                N°
                            </th>
                            <th>
                                Producto
                            </th>
                            <th>
                                Cantidad
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detalle_venta as $d)

                        <tr>
                            <td class="text-center">
                                {{$d->sale_id}}
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                
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