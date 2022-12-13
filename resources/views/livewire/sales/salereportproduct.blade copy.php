<div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 text-center">
            <p class="h1"><b>PRODUCTOS MAS VENDIDOS</b></p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Buscar</b>
            <div class="form-group">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-gp">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" wire:model="search" placeholder="Ingrese Nombre o código" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Seleccionar Sucursal</b>
            <div class="form-group">
                <select wire:model="sucursal_id" class="form-control">
                    @foreach($this->listasucursales as $sucursal)
                    <option value="{{$sucursal->id}}">{{$sucursal->name}}</option>
                    @endforeach
                    <option value="Todos">Todas las Sucursales</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Seleccionar Usuario</b>
            <div class="form-group">
                <select wire:model="user_id" class="form-control">
                    <option value="Todos" selected>Todos</option>
                    @foreach ($this->listausuarios as $u)
                        <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Categoria</b>
            <div class="form-group">
                <select wire:model="categoria_id" class="form-control">
                    <option value="Todos" selected>Todos</option>
                    @foreach ($this->lista_categoria as $c)
                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->name)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Fecha Inicio</b>
            <div class="form-group">
                <input type="date" wire:model="dateFrom" class="form-control" >
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Fecha Fin</b>
            <div class="form-group">
                <input type="date" wire:model="dateTo" class="form-control" >
            </div>
        </div>
    </div>

    <center><div id="preloader_3" wire:loading.delay.longest>
                
            
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

    
    </div></center>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Producto</th>
                    <th>Código Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabla_productos->sortByDesc('cantidad_vendida') as $t)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{$t->nombre_producto}}
                    </td>
                    <td class="text-center">
                        {{$t->codigo_producto}}
                    </td>
                    <td class="text-center">
                        {{$t->cantidad_vendida}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- {{ $tabla_productos->links() }} --}}

</div>
