@section("css")

<style>
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



        /* Quitar Spinner Input */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
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
</style>

@endsection
<div>



    {{-- Verificando que se haya realizado el corte de caja --}}
    @if($this->corte_caja)


        <div class="">

            
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">


                                <div class="col-2 text-center">
                                    <p class="text-sm mb-1 text-uppercase font-weight-bold">Cliente Anónimo</p>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:change="clienteanonimo()" {{ $clienteanonimo ? 'checked' : '' }}>
                                    </div>
                                </div>






                                <div class="col-2 text-center">
                                    <p class="text-sm mb-1 text-uppercase font-weight-bold">Tipo de Pago</p>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option value="Elegir">Elegir</option>
                                        @foreach($carteras as $c)
                                        <option value="{{$c->idcartera}}">{{$c->nombrecartera}} - {{$c->dc}}</option>
                                        @endforeach
                                        @foreach($carterasg as $g)
                                        <option value="{{$g->idcartera}}">{{$g->nombrecartera}} - {{$g->dc}}</option>
                                        @endforeach
                                    </select>
                                </div>






                                <div class="col-2 text-center">
                                    <p class="text-sm mb-1 text-uppercase font-weight-bold">Total Artículos</p>
                                    <div class="form-control">
                                        <b>{{$this->total_items}}</b>
                                    </div>
                                </div>






                                <div class="col-2 text-center">
                                    <p class="text-sm mb-1 text-uppercase font-weight-bold">Total Venta</p>
                                    <div class="form-control">
                                        <b>{{number_format($this->total_bs,2)}} Bs</b>
                                    </div>
                                </div>






                                <div class="col-4 text-center">
                                    <p class="text-sm mb-1 text-uppercase font-weight-bold">Observación</p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" wire:model="observacion">
                                      </div>
                                </div>





                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row mt-4">



                <div class="col-lg-4 col-sm-6 mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <input id="code" type="text" wire:keydown.enter.prevent="$emit('scan-code',$('#code').val())" wire:model="buscarproducto" class="form-control " placeholder="Escanear o Buscar Producto..." autofocus>
                                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center">
                                <i class="fas fa-info" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            


                            @if(strlen($this->buscarproducto) > 0)
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Descripción</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder ps-2">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                
                
                                    @foreach ($listaproductos as $p)
                                    <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                {{ $p->nombre }}
                                                <b>({{ $p->barcode }})</b>
                                                {{ $p->precio_venta }} Bs
                                            </h6>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button  wire:click="increase({{ $p->id }})" class="btn btn-sm" style="background-color: rgb(10, 137, 235); color:aliceblue">
                                            <i class="fas fa-plus"></i>
                                        </button>
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





                        </div>
                    </div>
                </div>




                <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <div class="form-control">
                                    <h6 class="mb-0">Carrito de Ventas</h6>
                                </div>
                                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center">
                                <i class="fas fa-info" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            


                            @if ($this->total_items > 0)
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                            <th class="text-uppercase text-xxs font-weight-bolder">DESCRIPCIÓN</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder ps-2">PRECIO BS</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder ps-2">CANTIDAD</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder ps-2">IMPORTE</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder ps-2">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            {{ $item->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group"  style="min-width: 120px; max-width: 130px; align-items: center;">
                                                        <input type="number" style="max-height: 30px;" id="p{{$item->id}}"
                                                        wire:change="cambiarprecio({{$item->id}}, $('#p' + {{$item->id}}).val())"
                                                        value="{{ $item->price }}"
                                                        class="form-control" placeholder="Bs..">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Bs</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group"  style="min-width: 120px; max-width: 130px; align-items: center;">
                                                        <input type="number" style="max-height: 30px;" id="c{{$item->id}}" 
                                                        wire:change="cambiarcantidad({{$item->id}}, $('#c' + {{$item->id}}).val())"
                                                        value="{{$item->quantity}}"
                                                        class="form-control" placeholder="Cantidad...">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Uds</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            {{ $item->price * $item->quantity, 2 }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button title="Eliminar Producto" onclick="ConfirmarEliminar('{{ $item->id }}', '{{$item->name}}')" type="button" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        <i class="fas fa-trash text-default" ></i>
                                                    </button>
                                                    <button title="Quitar una unidad" wire:click.prevent="decrease({{ $item->id }})" type="button" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        <i class="fas fa-trash text-default" ></i>
                                                    </button>
                                                    <button title="Incrementar una unidad" wire:click.prevent="increase({{ $item->id }})" type="button" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        <i class="fas fa-trash text-default" ></i>
                                                    </button> 

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





                        </div>
                    </div>
                </div>




            </div>



            <div class="row">
                <div class="col-1 text-right">
                </div>
                <div class="col-10 text-center">
                    <h5>Nombre Cliente: <b>{{ucwords(strtolower($nombrecliente))}}</b></h5>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @if($this->total_items > 0)
                        <button onclick="ConfirmarLimpiar()" class="btn btn-button" style="background-color: #373839; color: white; border-color: black;">
                            Vaciar
                        </button>
                        @endif
                        <a href="{{ url('salelist') }}" class="btn btn-button" style="background-color: rgb(255, 255, 255); border: 1.8px solid #000000; color: black;">
                            <b>Lista Ventas</b>
                        </a>
                        <button wire:click.prevent="modalfinalizarventa()" class="btn btn-button" style="background-color: #11be32; color: white;">
                            Finalizar Venta
                        </button>
                    </div>
                </div>
                <div class="col-1 text-right">
                </div>
            </div>


        </div>



        @if($descuento_recargo >= 0)
            <button class="btn-flotante">Descuento {{$descuento_recargo}} Bs</button>
        @else
            <button class="btn-flotante">Recargo {{$descuento_recargo * -1}} Bs</button>
        @endif


        @include('livewire.pos.modal.modalfinalizarventa')
        @include('livewire.pos.modal.modalbuscarcliente')
        @include('livewire.pos.modal.modal_stock_insuficiente')
        @include('livewire.pos.modal.modallotesproducto')

    @else
        <div class="row sales layout-top-spacing">
            <div class="col-sm-12" >
                    <div class="widget widget-chart-one">
                        <div class="text-center">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <h1>No se selecciono ninguna caja</h1>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
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
                    </div>
            </div>

        </div>
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
                    'Detalle del error'+ @this.mensaje_toast,
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
                window.livewire.emit('clear-Product',idproducto)
                }
            })
    }
    


</script>
@endsection