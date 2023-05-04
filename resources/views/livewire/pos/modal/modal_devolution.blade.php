<div wire:ignore.self class="modal fade" id="modaldevolution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-sm" id="exampleModalLabel">DEVOLVER PRODUCTO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: black;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-4">
            <div class="col-12 col-sm-6 col-md-4 mb-3">
              <label>Buscar</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
                  <input wire:model="search_devolution" class="form-control" placeholder="Buscar Producto..." type="text">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
              <label>Fecha Inicio</label>
              <input wire:model="date_from_devolution" type="date" class="form-control">
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
              <label>Fecha Fin</label>
              <input wire:model="date_of_devolution" type="date" class="form-control">
            </div>
          </div>
          <div class="table-static">
            <table>
              <thead class="text-sm">
                <tr class="text-center">
                  <th>#</th>
                  <th>Código</th>
                  <th>Fecha</th>
                  <th class="text-end">Total</th>
                  <th>Usuario</th>
                  <th>Cartera</th>
                  <th>Sucursal</th>
                </tr>
              </thead>
              <tbody class="text-sm">
                @foreach ($list_sales_devolution as $pd)
                <tr class="fila-click" style="cursor: pointer;">
                  <th class="text-center" scope="row">{{ ($list_sales_devolution->currentpage() - 1) * $list_sales_devolution->perpage() + $loop->index + 1 }}</th>
                  <td class="text-center">
                    {{$pd->code}}
                  </td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($pd->created)->format('d/m/Y H:i') }}</td>
                  <td class="text-end">{{number_format($pd->total, 2, ',', '.')}}</td>
                  <td class="text-center">{{$pd->user}}</td>
                  <td class="text-center">{{$pd->wallet}}</td>
                  <td class="text-center">{{$pd->branch}}</td>
                </tr>
                <tr class="detalles" style="display:none;">
                  <td colspan="7">
                    <div class="table-product">
                      <table>
                        <thead>
                          <tr class="text-center">
                            <th>No</th>
                            <th>Producto</th>
                            <th>Código</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($pd->saledetail as $d)
                          <tr>
                            <td class="text-center">
                              {{$loop->iteration}}
                            </td>
                            <td>
                              <span class="product-devolution" wire:click.prevent='select_product({{$d->idsaledetail}})'>
                                {{$d->name_product}}
                              </span>
                            </td>
                            <td>
                              {{$d->code_product}}
                            </td>
                            <td class="text-center">
                              {{$d->price}}
                            </td>
                            <td class="text-center">
                              {{$d->quantity}}
                            </td>
                            <td class="text-center">
                              {{$d->price * $d->quantity}}
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $list_sales_devolution->links() }}
          </div>
          @if($this->product_id_devolution > 0)
          <br>
          <div class="row">
            <div class="col-12 text-center">
              <h5>
                {{$this->product_name_devolution}}
              </h5>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3"></div>
            <div class="col-12 col-sm-6 col-md-3 text-center">
              <label>Cantidad:</label>
              <input type="number" class="form-control">
            </div>
            <div class="col-12 col-sm-6 col-md-3 text-center">
              <label>Guardar en:</label>
              <select class="form-select">
                <option value=""></option>
              </select>
            </div>
            <div class="col-12 col-sm-6 col-md-3"></div>
          </div>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn bg-gradient-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>