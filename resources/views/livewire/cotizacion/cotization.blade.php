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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Lista</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Cotización </h6>
    </nav>
@endsection


@section('cotizacionnav')
    "nav-link active"
@endsection


@section('cotizacionli')
    "nav-item active"
@endsection




@section('css')
    <style>
        #slide {
            height: 390px !important;
            overflow: auto;
            width: 750px;
        }
    </style>
@endsection
<div>
    <div class="card-header pt-0">
        <div class="d-lg-flex">
            <div>
                <h5 class="text-white" style="font-size: 16px">Cotizaciones</h5>
            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                    <button wire:click="modalbuscarproducto()" class="btn btn-add mb-0"> <i
                            class="fas fa-plus me-2"></i>
                        Nueva cotización</button>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="card">
        <div class="card-body">
            <div class="">
                <div class="col-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <div class="form-group">
                            <h6>Buscar</h6>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search" placeholder="Nombre Cliente..." class="form-control ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr class="text-center">
                            <th>
                                No
                            </th>
                            <th>
                                Cliente
                            </th>
                            <th>
                                Total Bs
                            </th>
                            <th>
                                Fecha Creación
                            </th>
                            <th>
                                Fecha Vigencia
                            </th>
                            <th>
                                Dias Restantes
                            </th>
                            <th>
                                Estado
                            </th>
                            <th>
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista_cotizaciones as $c)
                        <tr>
                            <td class="text-center">
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$c->nombrecliente}}
                            </td>
                            <td style="text-align: right;">
                                {{ number_format($c->totalbs, 2, ',', '.') }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($c->fechacreacion)->format('d/m/Y H:i') }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($c->finaldate)->format('d/m/Y') }}
                            </td>
                            <td class="text-center">
                                {{$c->diasrestantes =='Vencido'?'Vencido': $c->diasrestantes+1}}
                            </td>
                            <td class="text-center">
                                @if ($c->estado == "ACTIVO")
                                    <span style="background-color: #4894ef; padding: 2px; border-radius: 7px;">
                                        ACTIVO
                                    </span>
                                @else
                                    <span style="background-color: #f3112b; padding: 2px; border-radius: 7px;">
                                        INACTIVO
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">

                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="javascript:void(0)" wire:click="ShowModalDetail({{$c->idcotizacion}})"
                                        class="mx-3" title="Ver detalles de la cotización">
                                        <i class="fas fa-bars text-warning" aria-hidden="true"></i>
                                    </a>
                                    {{-- <a href="javascript:void(0)"
                                        class="mx-3" title="Editar Venta">
                                        <i class="fas fa-edit text-default" aria-hidden="true"></i>
                                    </a> --}}
                                    <a href="javascript:void(0)" wire:click="crearcomprobante({{ $c->idcotizacion }})"
                                        class="mx-3" title="Crear Comprobante de Cotización">
                                        <i class="fas fa-print text-success" aria-hidden="true"></i>
                                    </a>
                                    @if($c->estado == "ACTIVO")
                                        <a href="javascript:void(0)" onclick="ConfirmarAnular({{ $c->idcotizacion }}, '{{ $c->nombrecliente }}')" class="mx-3" title="Anular Cotización">
                                            <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('livewire.cotizacion.modal')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mètodo JavaScript para llamar al modal para buscar un producto
        window.livewire.on('show-details', Msg => {
            $("#modaldetails").modal("show");
        });

        //Mostrar cualquier tipo de mensaje toast de un OK
        window.livewire.on('message-ok', msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.message,
                padding: '2em',
            })
        });

        //Mostrar Mensaje a ocurrido un error en la venta
        window.livewire.on('message-error-sale', event => {
            swal(
                'Advertencia',
                @this.mensaje_toast,
                'info'
            )
        });
        //Crear pdf
        window.livewire.on('crear-comprobante', Msg => {
            var idventa = @this.cotization_id;
            var win = window.open('pdfcotizacion/' + idventa);
            // Cambiar el foco al nuevo tab (punto opcional)
            win.focus();
        });
    });


    // Código para lanzar la Alerta para eliminar un producto del Carrito de cotizaciones
    function ConfirmarAnular(idcotization, nameclient)
    {
        swal({
            title: '¿Anular la Cotización?',
            text: "Se anulara la cotizacion " + idcotization + " del cliente " + nameclient,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Anular Cotización',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('delete-cotization', idcotization)
            }
        })
    }
</script>
