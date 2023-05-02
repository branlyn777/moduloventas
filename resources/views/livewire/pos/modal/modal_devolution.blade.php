<div wire:ignore.self class="modal fade" id="modaldevolution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-sm" id="exampleModalLabel">DEVOLVER PRODUCTO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-4">
            <div class="col-12 col-sm-6 col-md-4 mb-3">
              <label>Buscar</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
                  <input class="form-control" placeholder="Buscar Producto..." type="text">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
              <label>Fecha Inicio</label>
              <input type="date" class="form-control">
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
              <label>Fecha Fin</label>
              <input type="date" class="form-control">
            </div>
          </div>
          <div class="table-wrapper">
            <table>
              <thead class="text-sm">
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Código</th>
                  <th>Seleccionar</th>
                </tr>
              </thead>
              <tbody class="text-sm">
                @foreach ($list_products_devolution as $pd)
                <tr class="fila-click">
                  <th scope="row">1</th>
                  <td>{{$pd->nombre}}</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr class="detalles" style="display:none;">
                  <td colspan="3">
                      <span class="text-sm">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero voluptates perferendis nostrum necessitatibus repellat ullam veritatis nam adipisci laudantium. Expedita dolor eum nulla fugit omnis quam amet esse sit aperiam?
                      </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $list_products_devolution->links() }}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn bg-gradient-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>