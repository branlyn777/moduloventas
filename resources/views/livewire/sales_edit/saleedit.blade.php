@section('css')

<style>
    /* Estilos para el Switch Cliente Anónimo y Factura*/
    .switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
    }
    .switch input {display:none;}
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgb(133, 133, 133);
    -webkit-transition: .4s;
    transition: .4s;
    }
    .slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 2px;
    bottom: 1px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }
    input:checked + .slider {
    background-color: #02b1ce;
    }
    input:focus + .slider {
    box-shadow: 0 0 1px #02b1ce;
    }
    input:checked + .slider:before {
    -webkit-transform: translateX(19px);
    -ms-transform: translateX(19px);
    transform: translateX(19px);
    }
    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }
    .slider.round:before {
    border-radius: 40%;
    }

        /* Estilos para las tablas */
        .table-wrapper {
        width: 100%;/* Anchura de ejemplo */
        height: 400px;  /*Altura de ejemplo*/
        overflow: auto;
        }

    .table-wrapper table {
        border-collapse: separate;
        border-spacing: 0;
        border-left: 0.3px solid #02b1ce;
        border-bottom: 0.3px solid #02b1ce;
        width: 100%;
    }
    .table-wrapper table thead {
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .table-wrapper table thead tr {
    background: #02b1ce;
    color: white;
    }
    .table-wrapper table tbody tr:hover {
        background-color: #bbf7ffa4;
    }
    .table-wrapper table td {
        border-top: 0.3px solid #02b1ce;
        padding-left: 10px;
        border-right: 0.3px solid #02b1ce;
    }

    /* Estilos para el encabesado de la pagina */
    .caja{
        position: relative;
        margin: 0 10px;
        border: 1.7px solid #02b1ce;
        background-color: #c4f6ff;
        border-radius: 15px;
    }

    /* Quitar Spinner Input */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }


    /* Estilo para el boton Descuento con estilo flotante */
    .btn-flotante {
    font-size: 16px; /* Cambiar el tamaño de la tipografia */
    text-transform: uppercase; /* Texto en mayusculas */
    font-weight: bold; /* Fuente en negrita o bold */
    color: rgba(0, 0, 0, 0.9); /* Color del texto */
    border-radius: 15px; /* Borde del boton */
    letter-spacing: 2px; /* Espacio entre letras */
    background-color: rgba(255, 255, 255, 0.6); /* Color de fondo */
    padding: 18px 30px; /* Relleno del boton */
    position: fixed;
    top: 237px;
    right: 50px;
    transition: all 300ms ease 0ms;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    z-index: 99;
    }
    .btn-flotante:hover {
    background-color: #ffffff; /* Color de fondo al pasar el cursor */
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(-7px);
    }
    @media only screen and (max-width: 600px) {
        .btn-flotante {
        font-size: 14px;
        padding: 12px 20px;
        right: 20px;
        }
    }




    /* Fondo de buscar productos */
    .animado {
	background: linear-gradient(-45deg, #bdffff, #ffffff, #d5faff, #ffffff);
	background-size: 400% 400%;
	animation: gradient 15s ease infinite;
    border-radius: 15px;
}

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }




        /* Estilos para el loading */
        .lds-roller {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        }
        .lds-roller div {
        animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 40px 40px;
        }
        .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #02b1ce;
        margin: -4px 0 0 -4px;
        }
        .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
        }
        .lds-roller div:nth-child(1):after {
        top: 63px;
        left: 63px;
        }
        .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
        }
        .lds-roller div:nth-child(2):after {
        top: 68px;
        left: 56px;
        }
        .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
        }
        .lds-roller div:nth-child(3):after {
        top: 71px;
        left: 48px;
        }
        .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
        }
        .lds-roller div:nth-child(4):after {
        top: 72px;
        left: 40px;
        }
        .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
        }
        .lds-roller div:nth-child(5):after {
        top: 71px;
        left: 32px;
        }
        .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
        }
        .lds-roller div:nth-child(6):after {
        top: 68px;
        left: 24px;
        }
        .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
        }
        .lds-roller div:nth-child(7):after {
        top: 63px;
        left: 17px;
        }
        .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
        }
        .lds-roller div:nth-child(8):after {
        top: 56px;
        left: 12px;
        }
        @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>
@endsection
<div>
    <div class="form-group caja">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-2 text-center">
                <h3><b>Cliente Anónimo</b></h3>
                <div class="form-group">
                    <label class="switch">
                    <input type="checkbox" wire:change="clienteanonimo()" {{ $clienteanonimo ? 'checked' : '' }}>
                    <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-2 text-center">
                <h3><b>Factura</b></h3>
                <div class="form-group">
                    <label class="switch">
                    <input type="checkbox" wire:change="facturasino()" {{ $factura ? 'checked' : '' }}>
                    <span class="slider round"></span>
                    </label>
                </div>
            </div>
    
            <div class="col-12 col-sm-6 col-md-2 text-center">
                <h3><b>Tipo de Pago</b></h3>
                <div class="form-group">
                    <select wire:model="cartera_id" class="form-control">
                        @foreach($carteras as $c)
                        <option value="{{$c->idcartera}}">{{$c->nombrecartera}} - {{$c->dc}}</option>
                        @endforeach
                        @foreach($carterasg as $g)
                        <option value="{{$g->idcartera}}">{{$g->nombrecartera}} - {{$g->dc}}</option>
                        @endforeach
                        <option value="Elegir">Elegir</option>
                    </select>
                </div>
            </div>
    
            <div class="col-12 col-sm-6 col-md-2 text-center">
                <h3><b>Total Artículos</b></h3>
                <div class="form-group">
                    <h4>{{$this->total_items}}</h4>
                </div>
            </div>
    
            <div class="col-12 col-sm-6 col-md-2 text-center">
                <h3><b>Total Venta</b></h3>
                <div class="form-group">
                    <h4>{{number_format($this->total_bs,2)}} Bs</h4>
                </div>
            </div>
    
            <div class="col-12 col-sm-6 col-md-2 text-center">
                <h3><b>Observación</b></h3>
                <div class="form-group">
                    <textarea class="form-control" aria-label="With textarea" wire:model="observacion"></textarea>
                </div>
            </div>
    
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 text-center">
                <h3><b>Lista de Productos</b></h3>
                <div class="input-group mb-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-gp">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input id="code" type="text" wire:keydown.enter.prevent="$emit('scan-code',$('#code').val())" wire:model="buscarproducto" class="form-control " placeholder="Escanear o Buscar Producto..." autofocus>
                    {{-- <input type="text" wire:model="buscarproducto" placeholder="Buscar Producto..." class="form-control"> --}}
                </div>
                <br>
                @if(strlen($this->buscarproducto) > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>DESCRIPCION</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listaproductos as $p)
                            <tr>
                                <td class="text-left">
                                    {{ $p->nombre }}
                                    <b>({{ $p->barcode }})</b>
                                    {{ $p->precio_venta }} Bs
                                </td>
                                <td>
                                    <button  wire:click="insert({{ $p->id }})" class="btn btn-sm" style="background-color: rgb(10, 137, 235); color:aliceblue">
                                        <i class="fas fa-plus"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $listaproductos->links() }}
                @else

                <div class="animado">
                    
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    PARA BUSCAR USE EL CUADRO: BUSCAR PRODUCTOS...
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>



                @endif
    
    
            </div>
            <div class="col-12 col-sm-6 col-md-8 text-center">
                <div class="row">
                    <div class="col-4">
                        
                    </div>
                    <div class="col-4">
                        <h3><b>Carrito de Ventas</b></h3>
                    </div>
                    <div class="col-4 text-right">
                        
                    </div>
                </div>
                @if($this->clienteanonimo)
                <div style="height: 44.2px;">

                </div>
                @else
                <div class="row" style="height: 44.2px;">
                    <div class="col-4 text-center">
                        
                    </div>
                    <div class="col-4 text-center">
                        <button wire:click="$emit('show-buscarcliente')" type="button" class="boton-azul-g">
                            Buscar o Crear Cliente
                        </button>
                    </div>
                    <div class="col-4 text-center">
                        
                    </div>
                </div>
                @endif
                <br>
                @if ($this->total_items > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>DESCRIPCIÓN</th>
                                <th>PRECIO BS</th>
                                <th>CANTIDAD</th>
                                <th>IMPORTE</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->carrito_venta->sortBy('order') as $c)
                            <tr>
                                <td class="text-center">
                                    {{ $c['order'] }}
                                </td>
                                <td class="text-left">
                                    {{ $c['name'] }}
                                </td>
                                <td>
                                    <div class="input-group"  style="min-width: 120px; max-width: 130px; align-items: center;">
                                        <input type="number" style="max-height: 30px;" id="p{{$c['id']}}"
                                        wire:change="cambiarprecio({{$c['id']}}, $('#p' + {{$c['id']}}).val())"
                                        value="{{ $c['price'] }}"
                                        class="form-control" placeholder="Bs.." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Bs</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group"  style="min-width: 120px; max-width: 130px; align-items: center;">
                                        <input type="number" style="max-height: 30px;" id="c{{$c['id']}}" 
                                        wire:change="cambiarcantidad({{$c['id']}}, $('#c' + {{$c['id']}}).val())"
                                        value="{{$c['quantity']}}"
                                        class="form-control" placeholder="Cantidad..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Uds</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $c['price'] * $c['quantity'], 2 }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {{-- <button title="Ver Precio y Costos por Lotes" wire:click.prevent="modal_lotes({{ $c['id'] }})" class="btn btn-sm" style="background-color: rgb(0, 156, 135); color:white">
                                            <i class="fas fa-list-ul"></i>
                                        </button> --}}
                                        <a title="Eliminar Producto" href="#" onclick="ConfirmarEliminar('{{ $c['id'] }}', '{{$c['name']}}')" class="btn btn-sm" style="background-color: red; color:white">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <button title="Quitar una unidad" wire:click.prevent="decrease({{ $c['id'] }})" class="btn btn-sm" style="background-color: #7c7a76; color:white">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button title="Incrementar una unidad" wire:click.prevent="increase({{ $c['id'] }})" class="btn btn-sm" style="background-color: #006caa; color:white">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="animado">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    AGREGAR PRODUCTOS A LA VENTA
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                @endif
                
                <div class="row">
                    <div class="col-1 text-right">
                    </div>
                    <div class="col-10 text-center">
                        <h5>Nombre Cliente: <b>{{ucwords(strtolower($this->nombrecliente))}}</b></h5>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @if($this->total_items > 0)
                            <button onclick="ConfirmarLimpiar()" class="btn btn-button" style="background-color: #373839; color: white; border-color: black;">
                                Vaciar Todo
                            </button>
                            @endif
                            <a href="{{ url('salelist') }}" class="btn btn-button" style="background-color: rgb(255, 255, 255); border: 1.8px solid #000000; color: black;">
                                <b>Cancelar Editar Venta</b>
                            </a>
                            @if($this->total_items > 0)
                            <button wire:click.prevent="update_sale()" class="btn btn-button" style="background-color: #7b00a0; color: white;">
                                Actualizar Venta
                            </button>
                            @endif
                        </div>
                    </div>
                    <div class="col-1 text-right">
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- @include('livewire.pos.modal.modalfinalizarventa') --}}
    @include('livewire.sales_edit.modal.modalbuscarcliente')
    {{-- @include('livewire.pos.modal.modalcrearcliente') --}}
    @include('livewire.sales_edit.modal.modal_stock_insuficiente')
    {{-- @include('livewire.pos.modal.modallotesproducto') --}}


    @if($descuento_recargo >= 0)
    <button class="btn-flotante">Descuento {{$descuento_recargo}} Bs</button>
    @else
    <button class="btn-flotante">Recargo {{$descuento_recargo * -1}} Bs</button>
    @endif


</div>


@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Mètodo JavaScript para llamar al modal para finalizar una Venta
        window.livewire.on('show-finalizarventa', Msg => {
            $("#modalfinalizarventa").modal("show");
        });
        // Mètodo JavaScript para llamar al modal para buscar un cliente
        window.livewire.on('show-buscarcliente', Msg => {
            $("#modalbuscarcliente").modal("show");
        });
        // Mètodo JavaScript para llamar al modal para crear un cliente
        window.livewire.on('show-crearcliente', Msg => {
            $("#modalcrearcliente").modal("show");
        });
        // Mètodo JavaScript para llamar al modal para mostrar mensaje de stock insuficiente
        window.livewire.on('show-stockinsuficiente', Msg => {
            $("#stockinsuficiente").modal("show");
        });
        //Mètodo JavaScript para llamar al modal para mostrar lotes con precio y costos
        window.livewire.on('show-modallotesproducto', Msg => {
            $("#modallotesproducto").modal("show");
        });
        //Mostrar Toast cuando un producto se incrementa en el Carrito de Ventas
        window.livewire.on('increase-ok', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.message,
                padding: '2em',
            })
        });
        //Mostrar Toast cuando un producto no se encuentra para ponerlo en el Carrito de Ventas
        window.livewire.on('increase-notfound', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
            });
            toast({
                type: 'warning',
                title: @this.message,
                padding: '2em',
            })
        });
        //Mostrar Toast cuando se use un cliente anónimo
        window.livewire.on('clienteanonimo-true', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
            });
            toast({
                type: 'info',
                title: @this.message,
                padding: '2em',
            })
        });
        //Mostrar Toast cuando no se use un cliente anónimo
        window.livewire.on('clienteanonimo-false', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'info',
                title: @this.message,
                padding: '2em',
            })
        });
        //Cierra la ventana Modal Buscar Cliente y muestra mensaje Toast cuando se selecciona un Cliente
        window.livewire.on('hide-buscarcliente', msg => {
            $("#modalbuscarcliente").modal("hide");
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.message,
                padding: '2em',
            })
        });
        //Cierra la ventana Modal Crear Cliente y muestra mensaje Toast de ese Cliente
        window.livewire.on('hide-crearcliente', msg => {
            $("#modalcrearcliente").modal("hide");
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.message,
                padding: '2em',
            })
        });
        //Cierra la ventana Modal Lotes Producto y muestra mensaje Toast Ok
        window.livewire.on('hide-modallotesproducto', msg => {
            $("#modallotesproducto").modal("hide");
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.message,
                padding: '2em',
            })
        });
        //Mostrar Mensaje Carrito de Ventas Vaciado exitosamente
        window.livewire.on('cart-clear', event => {
                swal(
                    '¡El Carrito de Ventas fue vaciado exitosamente!',
                    'Se eliminaron todos los productos correctamente',
                    'success'
                    )
            });

        //Cerrar ventana modal finalizar venta y mostrar mensaje toast de venta realizada con éxito
        window.livewire.on('sale-ok', msg => {
            $("#modalfinalizarventa").modal("hide");
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.message,
                padding: '2em',
            })
        });

        //Mostrar cualquier tipo de mensaje toast de un OK
        window.livewire.on('message-ok', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.message,
                padding: '2em',
            })
        });
        //Mostrar cualquier tipo de mensaje toast de advertencia
        window.livewire.on('message-warning', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
            });
            toast({
                type: 'warning',
                title: @this.message,
                padding: '2em',
            })
        });
        //Mostrar Mensaje a ocurrido un error en la venta
        window.livewire.on('sale-error', event => {
                swal(
                    'A ocurrido un error al realizar la venta',
                    'Detalle del error'+ @this.message,
                    'error'
                    )
            });
        //Mostrar Mensaje debe elegir una cartera
        window.livewire.on('show-elegircartera', event => {
            swal(
                '¡Seleccione Tipo de Pago!',
                'Por favor seleccione un tipo de pago distinto a elegir',
                'warning'
                )
        });
        //Llamando a una nueva pestaña donde estará el pdf modal
        window.livewire.on('opentap', Msg => {
            // Abrir nuevo tab $idventa . '/' . $totalitems
            var a = @this.total_bs;
            var b = @this.venta_id;
            var c = @this.total_items;

            var win = window.open('report/pdf/' + a + '/' + b + '/' + c);
            // Cambiar el foco al nuevo tab (punto opcional)
            // win.focus();

        });

    });


    // Código para lanzar la Alerta para Vaciar todos los productos del Carrito de Ventas
    function ConfirmarLimpiar()
    {
        swal({
            title: '¿Vaciar todo el contenido del Carrito de Ventas?',
            text: "Los valores de total articulos y total venta pasarán a ser 0",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Vaciar Todo',
            padding: '2em'
            }).then(function(result) {
            if (result.value) {
                window.livewire.emit('clear-Cart')
                }
            })
    }
    // Código para lanzar la Alerta para eliminar un producto del Carrito de Ventas
    function ConfirmarEliminar(idproducto, nombreproducto)
    {
        swal({
            title: '¿Eliminar el Producto?',
            text: "Se eliminará el producto '" + nombreproducto + "' del Carrito de Ventas",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Eliminar Producto',
            padding: '2em'
            }).then(function(result) {
            if (result.value) {
                window.livewire.emit('clear-product',idproducto)
                }
            })
    }
    


</script>


<!-- Scripts para el mensaje de confirmacion arriba a la derecha 'Mensaje Toast' de Éxito y Alerta de Eliminacion -->
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<!-- Fin Scripts -->
@endsection


