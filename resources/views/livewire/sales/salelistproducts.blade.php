<div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b style="color:#fcf8f8">Buscar</b>
            <div class="form-group">
                <input wire:model="search" type="text" class="form-control" placeholder="Ingrese Nombre o código">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b style="color:#fcf8f8">Seleccionar Sucursal</b>
            <div class="form-group">
                <select wire:model="sucursal_id" class="form-select">
                    @foreach($listasucursales as $sucursal)
                    <option value="{{$sucursal->id}}">{{$sucursal->name}}</option>
                    @endforeach
                    <option value="Todos">Todas las Sucursales</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b style="color:#fcf8f8">Seleccionar Usuario</b>
            <div class="form-group">
                <select wire:model="user_id" class="form-select">
                    <option value="Todos" selected>Todos</option>
                    @foreach ($listausuarios as $u)
                        <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b style="color:#fcf8f8">Categoria</b>
            <div class="form-group">
                <select wire:model="categoria_id" class="form-select">
                    <option value="Todos" selected>Todos</option>
                    @foreach ($this->lista_categoria as $c)
                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->name)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b style="color:#fcf8f8">Fecha Inicio</b>
            <div class="form-group">
                <input type="date" wire:model="dateFrom" class="form-control" >
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b style="color:#fcf8f8">Fecha Fin</b>
            <div class="form-group">
                <input type="date" wire:model="dateTo" class="form-control" >
            </div>
        </div>
    </div>



  




    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Productos Vendidos</h6>
                  </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 text-center"> 
                        <b>Total Utilidad</b>
                        <div class="form-group">
                            <div class="">
                                <p class="h4"><b>{{ number_format($this->total_utilidad, 2, ",", ".")}} Bs</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 text-center"> 
                        <b>Total Precio</b>
                        <div class="form-group">
                            <div class="">
                                <p class="h4"><b>{{ number_format($this->total_precio, 2, ",", ".")}} Bs</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-xxs font-weight-bolder text-center">Codigo</th>
                            <th class="text-uppercase text-xxs font-weight-bolder ps-2">Producto</th>
                            <th class="text-center text-uppercase text-xxs font-weight-bolder">Código Producto</th>
                            <th class="text-center text-uppercase text-xxs font-weight-bolder">Cantidad</th>
                            <th class="text-center text-uppercase text-xxs font-weight-bolder">Precio</th>
                            <th class="text-center text-uppercase text-xxs font-weight-bolder">Usuario</th>
                            <th class="text-center text-uppercase text-xxs font-weight-bolder">Sucursal</th>
                            <th class="text-center text-uppercase text-xxs font-weight-bolder">Fecha</th>
                          </tr>
                        </thead>
                        <tbody>
      
      
      
                          @foreach ($listaproductos as $l)
                          <tr>
                            <td class="align-middle text-center text-sm">
                              <p class="text-xs font-weight-bold mb-0 ">{{$l->codigo}}</p>
                            </td>
  
                            <td>
                              <p class="text-xs font-weight-bold mb-0">{{$l->nombre_producto}}</p>
                            </td>
  
                            <td class="align-middle text-center text-sm">
                              <p class="text-xs font-weight-bold mb-0">{{$l->codigo_producto}}</p>
                            </td>
  
                            <td class="align-middle text-center ">
                              <p class="text-xs font-weight-bold mb-0">{{$l->cantidad_vendida}}</p>
                            </td>
  
                            <td class="align-middle text-center ">
                              <p class="text-xs font-weight-bold mb-0">{{$l->precio_venta}}</p>
                            </td>
  
                            <td class="align-middle text-center ">
                              <p class="text-xs font-weight-bold mb-0">{{$l->nombre_vendedor}}</p>
                            </td>
  
                            <td class="align-middle text-center ">
                              <p class="text-xs font-weight-bold mb-0">{{$l->nombresucursal}}</p>
                            </td>
  
                            <td class="align-middle text-center ">
                              @if($l->ventareciente > -1)
                                  @if($l->ventareciente == 1)
                                  <div style="color: rgb(0, 201, 33);">
                                      <b>Hace {{$l->ventareciente}} Minuto</b>
                                  </div>
                                  @else
                                  <div style="color: rgb(0, 201, 33);">
                                      <b>Hace {{$l->ventareciente}} Minutos</b>
                                  </div>
                                  @endif
                              @endif
                              {{ \Carbon\Carbon::parse($l->fecha_creacion)->format('d/m/Y H:i') }}
                          </td>
  
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $listaproductos->links() }}
                    </div>
                  </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    

</div>
