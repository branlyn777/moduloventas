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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Ordenes de Servicios</h6>
    </nav>
@endsection

@section('serviciocollapse')
    nav-link
@endsection

@section('servicioarrow')
    true
@endsection

@section('ordenservicionav')
    "nav-link active"
@endsection

@section('servicioshow')
    "collapse show"
@endsection

@section('ordenservicioli')
    "nav-item active"
@endsection


@section('css')
    <style>

        /* Estilos para la lista de marcas disponibles a elegir en la ventana modal editar */
        .product-search {
            position: relative;
        }
        #product-input {
            width: 100%;
            padding: 10px;
            /* font-size: 16px; */
        }
        #product-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        #product-list li {
            padding: 10px;
            cursor: pointer;
            font-size: 12px;
        }
        #product-list li:hover {
            background-color: #5e72e4;
            color: white;
        }


        /* Estilos para las tablas */
        .table-wrapper {
            width: 100%;
            /* Anchura de ejemplo */
            height: 307px;
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
            background-color: #5e72e4;
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











        /* Estilos para los inputs de la ventana modal cliente */
        .input-number {
            height: 25px;
            width: 100px;
            font-size: 14px;
            border: 2px solid #ccc; /* Establecer el ancho y el color del borde */
            border-radius: 7px; /* Hacer el borde más circular */
            text-align: center;
        }
        .input-number input:focus {
            border: 0.5px solid rgb(0, 197, 26);
            outline: none;
        }

        .clic-action {
            cursor: pointer;
        }
        .clic-action:hover {
            background-color: #8290db;
            color: white;
            padding: 2px;
            border-radius: 7px;
        }









    </style>
@endsection
<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    @if (!empty(session('od')))
                    <h5 class=" text-white" style="font-size: 16px"></i>Actualizar Órden de Servicio</h5>
                    @else
                    <h5 class=" text-white" style="font-size: 16px"></i>Nueva Órden de Servicio</h5>
                    @endif
                    
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        @if ($orderservice == 0 || $cliente == '')
                            <button class="btn btn-add" wire:click="$emit('show-modalclient')">
                                Buscar/Crear Cliente
                            </button>
                        @endif

                        @if (!empty($cliente))
                            <a href="javascript:void(0)" class="btn btn-add mb-0" wire:click="modalswhow()">Agregar Servicio</a>
                        @endif
                        @if ($orderservice != 0)
                            <a href="javascript:void(0)" class="btn btn-add mb-0" wire:click="$emit('modaltype-show')">Tipo De Servicio</a>
                        @endif

                        <button class="btn btn-add mb-0" wire:click="ResetSession">Ir a Órdenes de Servicio</button>
                        <button class="btn btn-add mb-0" wire:click="ShowModalFastService()">Servicio Rápido</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- <div class="widget-heading" style="color: #000000">
                            <h5 class="card-title">
                                <h5>{{ $pageTitle }} {{ $orderservice == '0' ? 'NO DEFINIDO' : $orderservice }} </h5>
                            </h5>
                        </div> --}}

                        <div class="col-2">
                            <span class="me-2 text-sm">
                                <b>Cliente: </b>
                                @if (!empty($cliente))
                                    {{ $cliente->nombre }}
                                @else
                                    NO DEFINIDO
                                @endif
                            </span>
                        </div>
                        <div class="col-2">
                            <span class="me-2 text-sm">
                                <b>Fecha: </b>{{ $from }}
                            </span>
                        </div>
                        <div class="col-2">
                            <span class="me-2 text-sm">
                                <b>Registrado por: </b>{{ $usuariolog }}
                            </span>
                        </div>
                        <div class="col-2">
                            <span class="me-2 text-sm">
                                <b>Tipo de servicio: </b> {{ $typeservice }}
                            </span>
                        </div>
                        <div class="col-2" style="text-align: right;">
                            <span class="me-2 text-sm">
                                @if (!empty(session('od')))
                                    <a class="btn btn-success mb-0"
                                        href="{{ url('reporte/pdf' . '/' . $orderservice) }}" target="_blank"
                                        wire:click="ResetSession">Guardar e Imprimir</a>
                                @endif
                            </span>
                        </div>
                        <div class="col-2">
                            <span class="me-2 text-sm">
                                <a class="btn btn-success mb-0"
                                href="{{ url('ordenesservicios') }}" wire:click="ResetSession">Salir</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="align-items-center mb-0" style="width: 100%;">
                            <thead>
                                <tr class="text-center">
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">#</th>
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">EQUIPO</th>
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">MARCA</th>
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">DETALLE</th>
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">ESTADO</th>
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">TOTAL</th>
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">A CUENTA</th>
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">SALDO</th>
                                    <th style="padding-top: 10px; padding-bottom: 10px;"
                                        class="text-uppercase text-xs font-weight-bolder">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="text-center">
                                        <td>
                                            <span class="me-2 text-sm">
                                                {{ $loop->iteration }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="me-2 text-sm">
                                                {{ $item->category }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="me-2 text-sm">
                                                {{ $item->marca }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="me-2 text-sm">
                                                {{ $item->detalle }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="me-2 text-sm">
                                                {{ $item->tipo }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="me-2 text-sm">
                                                {{ $item->import }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="me-2 text-sm">
                                                {{ $item->on_account }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="me-2 text-sm">
                                                {{ $item->saldo }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                class="btn btn-primary btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if ($item->tipo != 'TERMINADO' && $item->tipo != 'ENTREGADO')
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $item->id }}','{{ $item->category }}','{{ $item->marca }}')"
                                                    class="btn btn-warning btn-sm" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.servicio.formservicio')
        @include('livewire.servicio.formtiposervicio')
        @include('livewire.servicio.formfastservice')
        @include('livewire.servicio.formclient')
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Selecciona una opción',
            allowClear: true
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-fastservice', msg => {
            $('#fastservice').modal('show')
        });
        window.livewire.on('hide-fastservice', msg => {
            $('#fastservice').modal('hide')
        });
        window.livewire.on('client-selected', msg => {
            $('#theClient').modal('hide'),
                noty(msg)
        });
        window.livewire.on('service-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('tipoServ-updated', msg => {
            $('#theType').modal('hide')
            noty(msg)
        });
        window.livewire.on('service-deleted', msg => {
            noty(msg)
        });
        window.livewire.on('item-error', msg => {
            noty(msg)
        });
        window.livewire.on('modalsearchc-show', msg => {
            $('#theClient').modal('show')
        });
        window.livewire.on('modalsearch-hide', msg => {
            $('#theClient').modal('hide')
        });
        window.livewire.on('modalclient-show', msg => {
            $('#theNewClient').modal('show')
        });
        window.livewire.on('modalclient-hide', msg => {
            $('#theNewClient').modal('hide')
        });
        window.livewire.on('modalclient-selected', msg => {
            $('#theNewClient').modal('hide'),
                noty(msg)
        });
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('modal-selected', msg => {
            $('#theModal').modal('hide'),
                noty(msg)
        });
        window.livewire.on('modaltype-show', msg => {
            $('#theType').modal('show')
        });
        window.livewire.on('modaltype-hide', msg => {
            $('#theType').modal('hide')
        });
        window.livewire.on('modaltype-selected', msg => {
            $('#theType').modal('hide'),
                noty(msg)
        });
        window.livewire.on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        });
        window.livewire.on('show-modalclient', msg => {
            $('#modalclient').modal('show')
        });
        window.livewire.on('hide-modalclient', msg => {
            $('#modalclient').modal('hide')
        });


        //Crear pdf de Informe técnico de un servicio
        window.livewire.on('crear-comprobante', Msg => {
            var idorderservice = @this.service_order_id;
            var win = window.open('reporte/pdf/' + idorderservice);
        });



        //Código que se ejecuta cuando se haga click para lanzar la ventana modal Servicio (carga las marcas en el input con el id product-input)
        Livewire.on('marks-loaded', function(data) {
        //Actualzando la variable @this.s_mark
        const miInputmark = document.getElementById('product-input');
        // miInputmark.value = @this.s_mark;
        //------------

        const list_marks = data;
        const products = list_marks.map(m => m.name);
        const input = document.getElementById('product-input');
        const list = document.getElementById('product-list');

        input.addEventListener('input', function() {
            // Limpiar lista de productos
            list.innerHTML = '';

            // Obtener valor del input
            const value = input.value.toLowerCase();

            // Filtrar productos que coincidan con el valor ingresado
            const filteredProducts = products.filter(function(product) {
                return product.toLowerCase().includes(value);
            });

            // Agregar productos filtrados a la lista
            filteredProducts.forEach(function(product) {
                const li = document.createElement('li');
                li.textContent = product;
                li.addEventListener('click', function() {
                    @this.marc = product;
                    input.value = product;
                    list.innerHTML = '';
                });
                list.appendChild(li);
            });

            // Mostrar lista de productos si hay resultados
            if (filteredProducts.length > 0) {
                list.style.display = 'block';
            } else {
                list.style.display = 'none';
            }
        });

            // Ocultar lista de productos al hacer clic fuera del input
            document.addEventListener('click', function(event) {
                if (event.target !== input && event.target.parentNode !== list) {
                    list.innerHTML = '';
                }
            });
        });


    });

    function Confirm(id, categoria, marca)
    {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el servicio "' + categoria + '" de marca "' + marca + '"',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
    function SelectClient(idcliente, idcelular, idtelefono)
    {
        var celular = document.getElementById(idcelular).value;
        var telefono = document.getElementById(idtelefono).value;
        
        window.livewire.emit('selectclient', idcliente, celular, telefono)
    }
    function ClearNumbers(idcelular, idtelefono)
    {
        document.getElementById(idcelular).value = '';
        document.getElementById(idtelefono).value = '';
    }
</script>