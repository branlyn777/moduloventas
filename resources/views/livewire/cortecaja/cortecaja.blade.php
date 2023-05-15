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
        <h6 class="font-weight-bolder mb-0 text-white"> Corte de Caja </h6>
    </nav>
@endsection
@section('css')
    <style>
        .nohover:hover {
            background-color: rgb(255, 255, 255);
        }

        .hr-sm {
            height: 1.3px;
            border: none;
            background-color: #aea9a9;
            margin: 5px 0;
        }
    </style>
@endsection


@section('cortecajanav')
    "nav-link active"
@endsection

@section('cortecajali')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12 text-left text-white">
            <p class="h5 text-white"><b>Cajas Disponibles</b></p>
            <p>Seleccione la caja en la cual va a trabajar</p>
        </div>
    </div>
    <br>
    <div class="col-sm-12 col-md-12">
        <div class="row">

            @foreach ($cajas as $c)
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <b>{{ $c->nombre }}</b>
                            <br>
                            <div class="connect-sorting text-left">
                                <b>Abierta por:</b> {{ substr($c->abiertapor, 0, 15) }}
                            </div>
                            <br>
                            <div class="connect-sorting text-center">
                                @if ($c->estado == 'Abierto')
                                    @if ($this->nombre_caja != null)
                                        @if ($c->id == $this->id_caja)
                                            <button type="button"
                                                wire:click="CerrarCaja({{ $c->id }},'{{ $c->abiertapor_id }}')"
                                                class="btn btn-danger">
                                                <i class="fas fa-arrow-right"></i>
                                                Cerrar Sesion
                                            </button>
                                        @else
                                            @if ($c->misucursal)
                                                <p>
                                                    <b>Para usar esta caja cierre la caja
                                                        "{{ $this->nombre_caja }}"</b>
                                                </p>
                                            @endif
                                        @endif
                                    @else
                                        <button
                                            onclick="ConfirmarCerrarUsuario({{ $c->id }},'{{ $c->nombre }}','{{ $c->abiertapor }}','{{ $c->abiertapor_id }}')"
                                            class="btn btn-primary">
                                            CERRAR CAJA DE OTRO USUARIO
                                        </button>
                                    @endif
                                @else
                                    @if ($this->nombre_caja != null)
                                        @if ($c->misucursal)
                                            <p>
                                                <b class='text-xs'>Para usar esta caja cierre la caja
                                                    "{{ $this->nombre_caja }}"</b>
                                            </p>
                                        @endif
                                    @else
                                        @if ($c->misucursal)
                                            <button wire:click="confirmarAbrir('{{ $c->id }}')"
                                                class="btn btn-primary">
                                                <i class="fas fa-arrow-up"></i>

                                                Abrir Caja

                                            </button>
                                        @endif
                                    @endif


                                @endif

                            </div>




                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
    @include('livewire.cortecaja.cierreCaja')
    @include('livewire.cortecaja.aperturacaja')
    @include('livewire.cortecaja.contador')
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //Para mostrar mensaje de caja ya ocupada cuando se desee realizar corte de caja
            window.livewire.on('caja-ocupada', msg => {
                swal({
                    title: 'Caja Ocupada',
                    text: "Un usuario ya abrio la caja seleccionada",
                    type: 'info',
                    showCancelButton: false,
                    cancelButtonText: 'Aceptar',
                    padding: '2em'
                });
            });
            //Para mostrar mensaje de caja ya cerrada cuando se desee cerrar una caja
            window.livewire.on('caja-cerrada', msg => {
                swal({
                    title: 'Caja cerrada anteriormente',
                    text: "Un usuario ya cerro la Caja seleccionada antes que usted lo haga",
                    type: 'info',
                    showCancelButton: false,
                    cancelButtonText: 'Aceptar',
                    footer: '<a href="cortecajas">Recargue la Pagina</a>',
                    padding: '2em'
                });
            });

            window.livewire.on('abrirAjustedeCaja', msg => {
                $('#ajusteCaja').modal('show')
            });
            window.livewire.on('cerrarAjustedeCaja', msg => {
                $('#ajusteCaja').modal('hide')
            });

            window.livewire.on('cerrarContador', msg => {
                $('#contador_monedas').modal('hide');

            });
            window.livewire.on('aperturarCaja', msg => {
                $('#aperturacaja').modal('show')
            });
            window.livewire.on('aperturarCajaCerrar', msg => {
                $('#aperturacaja').modal('hide')
            });
        });

        // Código para lanzar la Alerta de Confirmación para cerrar una caja abierta por otro usuario
        function ConfirmarCerrarUsuario(id, nombrecaja, nombreusuario, userid) {
            swal({
                title: 'Confirmar Cierre de Caja de Otro usuario',
                text: '¿Desea proseguir con el cierre de la caja: ' + nombrecaja + ' ,abierta por ' +
                    nombreusuario + '?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('cerrar-caja', id, userid)
                }
            });
        }
    </script>
@endsection
