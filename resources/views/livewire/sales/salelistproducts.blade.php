<div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 text-center">
            <p class="h1"><b>PRODUCTOS VENDIDOS</b></p>
        </div>
    </div>

    


    <div class="row">
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Buscar</b>
            <div class="form-group">
                <input wire:model="search" type="text" class="form-control" placeholder="Ingrese Nombre o código">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Seleccionar Sucursal</b>
            <div class="form-group">
                <select wire:model="sucursal_id" class="form-control">
                    @foreach($listasucursales as $sucursal)
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
                    @foreach ($listausuarios as $u)
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



    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 text-center">
            <b>Total Utilidad</b>
            <div class="form-group">
                <div class="">
                    <p class="h2"><b>{{ number_format($this->total_utilidad, 2, ",", ".")}} Bs</b></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 text-center">
            <b>Total Precio</b>
            <div class="form-group">
                <div class="">
                    <p class="h2"><b>{{ number_format($this->total_precio, 2, ",", ".")}} Bs</b></p>
                </div>
            </div>
        </div>
    </div>

    <center><div id="preloader_3" wire:loading.delay.longest>
                
            
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

    
    </div></center>



    <div class="table-1">
        <table>
            <thead>
                <tr class="text-center">
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Código Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Usuario</th>
                    <th>Sucursal</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listaproductos as $l)
                <tr>
                    <td class="text-center">
                        <span class="stamp stamp" style="background-color: #ee761c">
                            {{$l->codigo}}
                        </span>
                    </td>
                    <td>
                        {{$l->nombre_producto}}
                    </td>
                    <td class="text-center">
                        {{$l->codigo_producto}}
                    </td>
                    <td class="text-center">
                        {{$l->cantidad_vendida}}
                    </td>
                    <td class="text-right">
                        {{$l->precio_venta}}
                    </td>
                    <td class="text-center">
                        {{$l->nombre_vendedor}}
                    </td>
                    <td class="text-center">
                        {{$l->nombresucursal}}
                    </td>
                    <td class="text-center">
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
