<div>
      <br>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Productos Mas Vendidos</h6>
                    </div>

                    <div style="padding-left: 20px; padding-right: 20px;">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-2 text-center">
                                <h6 class="mb-0">
                                    Buscar
                                </h6>
                                <div class="form-group">


                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                        <input wire:model="search" placeholder="Ingrese Nombre o código" class="form-control">
                                    </div>


                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-2 text-center">
                                <h6 class="mb-0">
                                    Seleccionar Sucursal
                                </h6>
                                <div class="form-group">
                                    <select wire:model="sucursal_id" class="form-select">
                                        @foreach($this->listasucursales as $sucursal)
                                        <option value="{{$sucursal->id}}">{{$sucursal->name}}</option>
                                        @endforeach
                                        <option value="Todos">Todas las Sucursales</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-2 text-center">
                                <h6 class="mb-0">
                                    Seleccionar Usuario
                                </h6>
                                <div class="form-group">
                                    <select wire:model="user_id" class="form-select">
                                        <option value="Todos" selected>Todos</option>
                                        @foreach ($this->listausuarios as $u)
                                            <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-2 text-center">
                                <h6 class="mb-0">
                                    Categoria
                                </h6>
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
                                <h6 class="mb-0">
                                    Fecha Inicio
                                </h6>
                                <div class="form-group">
                                    <input type="date" wire:model="dateFrom" class="form-control" >
                                </div>
                            </div>
                    
                            <div class="col-12 col-sm-6 col-md-2 text-center">
                                <h6 class="mb-0">
                                    Fecha Fin
                                </h6>
                                <div class="form-group">
                                    <input type="date" wire:model="dateTo" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>


                    <center><div id="preloader_3" wire:loading.delay.longest>
                                
                            
                        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

                    
                    </div></center>


                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs font-weight-bolder">No</th>
                              <th class="text-uppercase text-xxs font-weight-bolder ps-2">Producto</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Código Producto</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Cantidad</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($tabla_productos->sortByDesc('cantidad_vendida') as $t)
                            <tr>
                                <td class="text-center">
                                    <p class="text-xs mb-0">
                                        {{ $loop->iteration }}
                                    </p>
                                </td>
                                <td>
                                    <p class="text-xs mb-0">
                                        {{$t->nombre_producto}}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs mb-0">
                                        {{$t->codigo_producto}}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs mb-0">
                                        {{$t->cantidad_vendida}}
                                    </p>
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
</div>