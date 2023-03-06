@section('css')
    <style>
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
                    <h5 class=" text-white" style="font-size: 16px"></i>Nuevo Servicio</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        @if ($orderservice == 0 || $cliente == '')
                            <button class="btn btn-add" wire:click="$emit('show-modalclient')">
                                Buscar/Crear Cliente
                            </button>
                        @endif

                        @if (!empty($cliente))
                            <a href="javascript:void(0)" class="btn btn-add mb-0" wire:click="$emit('modal-show')">Agregar Servicio</a>
                        @endif
                        @if ($orderservice != 0)
                            <a href="javascript:void(0)" class="btn btn-add mb-0" wire:click="$emit('modaltype-show')">Tipo De Servicio</a>
                        @endif

                        <button class="btn btn-add mb-0" wire:click="ResetSession">Ir a Órden de Servicio</button>
                        <button class="btn btn-add mb-0" wire:click="ShowModalFastService()">Servicio Rápido</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="widget-heading" style="color: #000000">
                            <h5 class="card-title">
                                <h5>{{ $pageTitle }} {{ $orderservice == '0' ? 'NO DEFINIDO' : $orderservice }} </h5>
                            </h5>
                        </div>
                        <div class="widget-heading" style="color: #000000">
                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                <div class="d-flex b-skills">
                                    <div class="infobox">
                                        <b class="info-text">Cliente: </b>
                                        @if (!empty($cliente))
                                            {{ $cliente->nombre }}
                                        @else
                                            NO DEFINIDO
                                        @endif <br />
                                        <b class="info-text">Fecha: </b>{{ $from }}<br />
                                        <b class="info-text">Registrado por: </b>{{ $usuariolog }} <br />
                                        <b class="info-text">Tipo de servicio: </b> {{ $typeservice }} <br />
                                    </div>
                                </div>

                                <div style="float:right;">
                                    @if (!empty(session('od')))
                                        <a class="btn btn-success mb-0"
                                            href="{{ url('reporte/pdf' . '/' . $orderservice) }}" target="_blank"
                                            wire:click="ResetSession">Imprimir</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="table-th text-withe text-center">#</th>
                                    <th class="table-th text-withe text-center">EQUIPO</th>
                                    <th class="table-th text-withe text-center">MARCA</th>
                                    <th class="table-th text-withe text-center">DETALLE</th>
                                    <th class="table-th text-withe text-center">ESTADO</th>
                                    <th class="table-th text-withe text-center">TOTAL</th>
                                    <th class="table-th text-withe text-center">A CUENTA</th>
                                    <th class="table-th text-withe text-center">SALDO</th>
                                    <th class="table-th text-withe text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <h6 class="text-center">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center">{{ $item->category }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center">{{ $item->marca }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $item->detalle }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center">{{ $item->tipo }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center">{{ $item->import }}</h6>
                                        </td>

                                        <td>
                                            <h6 class="text-center">{{ $item->on_account }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center">{{ $item->saldo }}</h6>
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
