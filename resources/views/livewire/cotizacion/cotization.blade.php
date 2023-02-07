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
        <h6 class="font-weight-bolder mb-0 text-white"> Cotización </h6>
    </nav>
@endsection


@section('Reportescollapse')
    nav-link
@endsection


@section('Reportesarrow')
    true
@endsection


@section('cotizationnav')
    "nav-link active"
@endsection


@section('Reportesshow')
    "collapse show"
@endsection

@section('cotizationli')
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
                                <input type="text" placeholder="nombre cotizacion" class="form-control ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.cotizacion.modal')
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mètodo JavaScript para llamar al modal para buscar un producto
        window.livewire.on('show-buscarproducto', Msg => {
            $("#modalbuscarproducto").modal("show");
        });

        //Cierra la ventana Modal Buscar Cliente y muestra mensaje Toast cuando se selecciona un producto
        window.livewire.on('hide-buscarproducto', msg => {
            $("#modalbuscarproducto").modal("hide");
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

        //Mostrar Mensaje a ocurrido un error en la venta
        window.livewire.on('message-error-sale', event => {
            swal(
                'Advertencia',
                @this.mensaje_toast,
                'info'
            )
        });
    });


    // Código para lanzar la Alerta para eliminar un producto del Carrito de cotizaciones
    function ConfirmarEliminar(idproducto, nombreproducto) {
        swal({
            title: '¿Eliminar el Producto?',
            text: "Se eliminará el producto '" + nombreproducto + "' del Carrito de Cotizaciones",
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
</script>
