<div class="modal fade" id="devolution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-sm" id="exampleModalLabel">DEVOLVER PRODUCTO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group mb-4">
              <span class="input-group-text"><i class="fa fa-search"></i></span>
              <input class="form-control" placeholder="Buscar Producto..." type="text">
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
                @foreach ($list_product_devolution as $pd)
                <tr>
                  <th scope="row">1</th>
                  <td>{{$pd->nombre}}</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn bg-gradient-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>