@section('css')
    <style>
        /* Estilos para el Switch Cliente Anónimo y Factura*/
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: default;
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

        input:checked+.slider {
            background-color: #5e72e4;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #5e72e4;
        }

        input:checked+.slider:before {
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
            width: 100%;
            /* Anchura de ejemplo */
            /* height: 407px; */
            /* Altura de ejemplo */
            overflow: auto;
        }

        .table-wrapper table {
            border-collapse: separate;
            border-spacing: 0;
            border-left: 0.3px solid #ffffff00;
            border-bottom: 0.3px solid #ffffff00;
            width: 100%;
        }

        .table-wrapper table thead {
            position: -webkit-sticky;
            /* Safari... */
            position: sticky;
            top: 0;
            left: 0;
        }

        .table-wrapper table thead tr {
            /* background: #ffffff;
                                color: rgb(0, 0, 0); */
        }

        /* .table-wrapper table tbody tr {
                                    border-top: 0.3px solid rgb(0, 0, 0);
                                } */
        .table-wrapper table tbody tr:hover {
            background-color: #8e9ce96c;
        }

        .table-wrapper table td {
            border-top: 0.3px solid #ffffff00;
            padding-left: 10px;
            border-right: 0.3px solid #ffffff00;
        }

        /* Quitar Spinner Input */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }


        /* Estilo para el boton Descuento con estilo flotante */
        .btn-flotante {
            font-size: 16px;
            /* Cambiar el tamaño de la tipografia */
            text-transform: uppercase;
            /* Texto en mayusculas */
            font-weight: bold;
            /* Fuente en negrita o bold */
            color: #5e72e4;
            /* Color del texto */
            border-radius: 15px;
            /* Borde del boton */
            border: 2px solid #5e72e4;
            /* Espacio entre letras */
            background-color: rgba(255, 255, 255, 0.6);
            /* Color de fondo */
            padding: 18px 30px;
            /* Relleno del boton */
            position: fixed;
            top: 237px;
            right: 50px;
            transition: all 300ms ease 0ms;
            z-index: 99;
        }

        .btn-flotante:hover {
            background-color: #ffffff;
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
            background: linear-gradient(-45deg, #5e72e400, #ffffff3a, #ffffff21, #5e72e400);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            border-radius: 15px;
            border: 0.9px solid #5e72e4;
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
            background: #5e72e4;
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


@section('asd')
    <style>

    </style>
@endsection


@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ventas</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Nueva Venta </h6>
    </nav>
@endsection


@section('nuevaventanav')
    "nav-link active"
@endsection


@section('nuevaventali')
    "nav-item active"
@endsection



<div>
    {{-- Verificando que se haya realizado el corte de caja --}}
    @if ($this->corte_caja)


        <div class="row">
            <div class="col-12">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Nueva Venta</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">


                            <a class="btn btn-add mb-0" href="cortecajas"
                                style="background-color: #2e48dc; color: white;">
                                Cerrar Caja
                            </a>

                            <button wire:click="modalingresoegreso()" class="btn btn-add mb-0"
                                style="background-color: #2e48dc; color: white;">
                                <i class="fas fa-plus me-2"></i>
                                Nuevo Ingreso/Egreso
                            </button>

                            <button wire:click="modalbuscarcliente()" class="btn btn-add mb-0"
                                style="background-color: #2e48dc; color: white;">
                                <i class="fas fa-plus me-2"></i>
                                Buscar/Crear Cliente
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <br>






        <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                    {{-- <div class="col-12 col-sm-6 col-md-2 text-center">
                        <b>Seleccionar Cliente</b>
                        <button wire:click="modalbuscarcliente()" type="button" class="btn btn-default">
                            Buscar/Crear
                        </button>



                    </div> --}}
                    <div class="col-12 col-sm-6 col-md-2 text-left">
                        <b>Tipo de Pago</b>
                        <div class="form-group">
                            <select wire:model="cartera_id" class="form-select">
                                <option value="Elegir">Elegir</option>
                                @foreach ($carteras as $c)
                                    <option value="{{ $c->idcartera }}">{{ $c->nombrecartera }} - {{ $c->dc }}
                                    </option>
                                @endforeach
                                @foreach ($carterasg as $g)
                                    <option value="{{ $g->idcartera }}">{{ $g->nombrecartera }} - {{ $g->dc }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-2 text-center">
                        <b>Total Artículos</b>
                        <div class="form-group">
                            <h6>{{ $this->total_items }}</h6>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <b>Total Venta</b>
                        <div class="form-group">
                            <h6>{{ number_format($this->total_bs, 2) }} Bs</h6>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-5 text-left">
                        <b>Observación</b>
                        <div class="form-group">
                            <input type="text" wire:model="observacion" class="form-control">
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row">


                <div class="col-12 col-sm-6 col-md-4">

                    <div class="card p-3" >




                        <div class="form-group">
                            <div class="input-group">
                                <span style="background-color: #5e72e4; color: white; border: #5e72e4;"
                                    class="input-group-text"><i class="fa fa-search"></i></span>
                                <input id="code" type="text" style="padding-left: 10px;"
                                    wire:keydown.enter.prevent="$emit('scan-code',$('#code').val())"
                                    wire:model="buscarproducto" class="form-control "
                                    placeholder="Escanear o Buscar Producto..." autofocus>
                            </div>
                        </div>


                        <div>
                            @if (strlen($this->buscarproducto) > 0)

                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="table-wrapper">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <p class=""><b>DESCRIPCION</b></p>
                                                        </th>
                                                        <th>
                                                            <p class=""><b>ACCIONES</b></p>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listaproductos as $p)
                                                        <tr>
                                                            <td class="text-left">
                                                                <p class="text-sm mb-0">
                                                                    {{ $p->nombre }}
                                                                    <b>({{ $p->barcode }})</b>
                                                                    {{ $p->precio_venta }} Bs
                                                                </p>
                                                            </td>
                                                            <td class="text-center">

                                                                @if ($p->estado == 'ACTIVO')
                                                                    <button title="Añadir al Carrito de Ventas"
                                                                        wire:click="increase({{ $p->id }})"
                                                                        class="btn btn-primary"
                                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                @else
                                                                    <button title="Producto inactivado"
                                                                        wire:click="increase({{ $p->id }})"
                                                                        class="btn btn-secondary"
                                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{ $listaproductos->links() }}
                            @else
                                <div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            PARA BUSCAR USE EL CUADRO: BUSCAR PRODUCTOS...
                                        </div>
                                    </div>
                                </div>


                            @endif
                        </div>
                    </div>

                </div>


                <div class="col-12 col-sm-6 col-md-8">

                    <div class="card" >

                        <div>
                            @if ($this->total_items > 0)


                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="table-wrapper">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase text-sm text-center">Nº</th>
                                                        <th class="text-uppercase text-sm ps-2 text-left">
                                                            <b>DESCRIPCION</b></th>
                                                        <th class="text-uppercase text-sm ps-2 text-left"><b>PRECIO</b>
                                                        </th>
                                                        <th class="text-uppercase text-sm ps-2 text-left">
                                                            <b>CANTIDAD</b></th>
                                                        <th class="text-uppercase text-sm ps-2 text-left"><b>IMPORTE</b>
                                                        </th>
                                                        <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($cart as $item)
                                                        <tr>
                                                            <td class="text-sm mb-0 text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td class="text-sm mb-0 text-left">
                                                                <p class="text-sm mb-0">

                                                                    {{ $item->name }}
                                                                </p>
                                                            </td>
                                                            <td class="text-sm mb-0 text-left">
                                                                <div class="input-group"
                                                                    style="min-width: 120px; max-width: 130px;">
                                                                    <input type="number" style="max-height: 30px;"
                                                                        id="p{{ $item->id }}"
                                                                        wire:change="cambiarprecio({{ $item->id }}, $('#p' + {{ $item->id }}).val())"
                                                                        value="{{ $item->price }}"
                                                                        class="form-control" placeholder="Bs.."
                                                                        aria-label="Recipient's username"
                                                                        aria-describedby="basic-addon2">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Bs</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-sm mb-0 text-left">
                                                                <div class="input-group"
                                                                    style="min-width: 120px; max-width: 130px;">
                                                                    <input type="number" style="max-height: 30px;"
                                                                        id="c{{ $item->id }}"
                                                                        wire:change="cambiarcantidad({{ $item->id }}, $('#c' + {{ $item->id }}).val())"
                                                                        value="{{ $item->quantity }}"
                                                                        class="form-control" placeholder="Cantidad..."
                                                                        aria-label="Recipient's username"
                                                                        aria-describedby="basic-addon2">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Uds</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-sm mb-0 text-left">
                                                                <p class="text-sm mb-0">
                                                                    {{ $item->price * $item->quantity, 2 }}
                                                                </p>
                                                            </td>
                                                            <td class="text-sm mb-0 text-center">

                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">

                                                                    <button title="Quitar una unidad"
                                                                        wire:click.prevent="decrease({{ $item->id }})"
                                                                        class="btn btn-secondary"
                                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                    <button title="Incrementar una unidad"
                                                                        wire:click.prevent="increase({{ $item->id }})"
                                                                        class="btn btn-primary"
                                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                    <button title="Eliminar Producto" href="#"
                                                                        onclick="ConfirmarEliminar('{{ $item->id }}', '{{ $item->name }}')"
                                                                        class="btn btn-danger"
                                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>

                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <br>

                                    <div class="row">
                                        <div class="col-12 text-center">
                                            AGREGAR PRODUCTOS A LA VENTA
                                        </div>
                                    </div>


                                    <br>
                                </div>


                            @endif
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 text-center"><br>
                            <p class="text-sm">
                                Nombre Cliente: <b>{{ ucwords(strtolower($nombrecliente)) }}</b>
                            </p>
                            
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @if ($this->total_items > 0)
                                    <button onclick="ConfirmarLimpiar()" type="button" class="btn btn-danger">
                                        <p class="text-sm mb-0">
                                            VACIAR
                                        </p>
                                    </button>
                                @endif
                                <a href="{{ url('ventalistaproductos') }}" class="btn btn-add mb-0"
                                    style="background-color: #2e48dc; color: white;">
                                    <p class="text-sm mb-0">
                                        LISTA VENTAS
                                    </p>
                                </a>

                                <button wire:click.prevent="showmodalcotization()" type="button"
                                    class="btn btn-warning">
                                    <p class="text-sm mb-0">
                                        COTIZACION
                                    </p>
                                </button>

                                <button wire:click.prevent="modalfinalizarventa()" type="button"
                                    class="btn btn-success">
                                    <p class="text-sm mb-0">
                                        FINALIZAR VENTA
                                    </p>
                                </button>

                            </div>
                        </div>
                        <div class="col-1 text-right">
                        </div>
                    </div>

                </div>
            </div>
        </div>


        @include('livewire.pos.modal.modalfinalizarventa')
        @include('livewire.pos.modal.modalbuscarcliente')
        @include('livewire.pos.modal.modal_stock_insuficiente')
        @include('livewire.pos.modal.modallotesproducto')
        @include('livewire.pos.modal.modal_ingreso_egreso')
        @include('livewire.pos.modal.modal_cotization')


        @if ($descuento_recargo >= 0)
            <button style="cursor: default" class="btn-flotante">Descuento {{ $descuento_recargo }} Bs</button>
        @else
            <button style="cursor: default" class="btn-flotante">Recargo {{ $descuento_recargo * -1 }} Bs</button>
        @endif
    @else
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">

            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card  mb-4">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 text-center">
                                <div class="numbers">
                                    <a href="{{ url('cortecajas') }}">
                                        <h5 class="font-weight-bolder">
                                            NO SE SELECCIONO NINGUNA CAJA
                                        </h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">

            </div>
        </div>



        <div class="row">
            @foreach ($this->cajas as $c)
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <b>Caja 1</b>
                        <br>
                        <button class="btn btn-primary mt-5" wire:click.prevent="confirmarAbrir({{$c->id}})">
                            Aperturar Caja
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @include('livewire.pos.modalcortecaja.aperturacaja')

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
            // Mètodo JavaScript para ocultar al modal para mostrar mensaje de stock insuficiente
            window.livewire.on('hide-stockinsuficiente', Msg => {
                $("#stockinsuficiente").modal("hide");
            });
            //Mètodo JavaScript para llamar al modal para mostrar lotes con precio y costos
            window.livewire.on('show-modallotesproducto', Msg => {
                $("#modallotesproducto").modal("show");
            });
            //Mètodo JavaScript para llamar al modal para mostrar lotes con precio y costos
            window.livewire.on('show-modalcotization', Msg => {
                $("#modalcotization").modal("show");
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
                    title: @this.mensaje_toast,
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
                    title: @this.mensaje_toast,
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
                    title: @this.mensaje_toast,
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
                    title: @this.mensaje_toast,
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
                    title: @this.mensaje_toast,
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
                    title: @this.mensaje_toast,
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
                    title: @this.mensaje_toast,
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
                    title: @this.mensaje_toast,
                    padding: '2em',
                })
            });
            //Mostrar cualquier tipo de mensaje toast de un OK
            window.livewire.on('mensaje-ok', msg => {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    padding: '2em'
                });
                toast({
                    type: 'success',
                    title: @this.mensaje_toast,
                    padding: '2em',
                })
            });
            //Mostrar cualquier tipo de mensaje toast de advertencia
            window.livewire.on('mensaje-advertencia', msg => {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    padding: '2em'
                });
                toast({
                    type: 'warning',
                    title: @this.mensaje_toast,
                    padding: '2em',
                })
            });
            //Mostrar Mensaje a ocurrido un error en la venta
            window.livewire.on('sale-error', event => {
                swal(
                    'A ocurrido un error al realizar la venta',
                    'Detalle del error' + @this.mensaje_toast,
                    'error'
                )
            });
            //Mostrar Mensaje a ocurrido un error en la venta
            window.livewire.on('message-error-sale', event => {
                swal(
                    'Advertencia',
                    @this.mensaje_toast,
                    'info'
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
            //Llamando al modal ingreso egreso
            window.livewire.on('show-modalingresoegreso', Msg => {
                $("#modalingresoegreso").modal("show");
            });

            //Creando un pdf para la cotizacion
            window.livewire.on('generatepdfcotizacion', Msg => {
                var a = @this.cotization_id;
                var win = window.open('pdfcotizacion/' + a);
                // Cambiar el foco al nuevo tab (punto opcional)
                win.focus();
            });
            window.livewire.on('aperturarCaja', msg => {
                $('#aperturacaja').modal('show')
            });
             //Para mostrar mensaje de caja ya ocupada cuando se desee realizar corte de caja
             window.livewire.on('caja-ocupada', msg => {
                swal({
                    title: 'Caja Ocupada',
                    text: "Un usuario ya abrio la caja seleccionada",
                    type: 'info',
                    showCancelButton: false,
                    cancelButtonText: 'Aceptar',
                    padding: '2em'
                })
            });
        });


        // Código para lanzar la Alerta para Vaciar todos los productos del Carrito de Ventas
        function ConfirmarLimpiar() {
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
        function ConfirmarEliminar(idproducto, nombreproducto) {
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
                    window.livewire.emit('clear-Product', idproducto)
                }
            })
        }
        function alerta_apertura(id)
        {
            swal({
                title: '¿Aperturar Caja?',
                text: "Realizará el corte de caja",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aperturar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('confirmar-Abrir', id)
                }
            })
        }
    </script>
@endsection