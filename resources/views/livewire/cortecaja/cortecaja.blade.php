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


@section('cortecajanav')
    "nav-link active"
@endsection

@section('cortecajali')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12 text-left text-white">
            <p class="h5 text-white"><b>Cajas Disponibles En Tu Sucursal</b></p>
            <p>Seleccione la caja en la cual va a trabajar</p>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body p-4 m-0">
            <div class="row m-3 justify-content-end">
                <div class="col-md-4 col-12 col-sm-12">
                    <h6>Sucursal</h6>
                    <select wire:model="idsucursal" class="form-select" name="" id="">
                        @foreach ($sucursales as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                        <option value="Todos">Todas las Sucursales</option>
                    </select>
                </div>

                {{-- Botones de Cerrar y Ajustar --}}


                <div class="col-12 col-md-2">
                    <h6 style="color: rgba(255, 255, 255, 0)">|</h6>
                    <button wire:click.prevent="cerrartodo()" class="btn btn-primary form-control">
                        Cerrar Todo
                    </button>
                </div>
                <div class="col-12 col-md-2">
                    <h6 style="color: rgba(255, 255, 255, 0)">|</h6>
                    <button wire:click.prevent="ajustarcarteras()" class="btn btn-primary form-control">
                        Ajustar
                    </button>
                </div>
            </div>
        </div>
    </div>



    <br>

    <div class="col-sm-12 col-md-12 d-flex">
        @foreach ($cajas as $c)
            <div class="card mx-2">
                <div class="card-body position-relative">
                    <div
                        class="{{ $c->estado == 'Abierto' ? 'card-body position-relative' : 'card-body position-relative' }}">
                        <div class="connect-sorting text-left">
                            <h5> <b>{{ $c->nombre }}</b> </h5>
                            <br>
                            <b>Sucursal:</b> {{ $c->nombresucursal }}
                        </div>
                        @if ($c->carteras->count() > 0 || $carteras_generales->count() > 0)

                            <div class="connect-sorting text-left">
                                <b>Abierta por:</b> {{ $c->abiertapor }}
                            </div>
                            <br>
                            <div class="connect-sorting text-center">

                                @if ($c->estado == 'Abierto')

                                    @if ($this->nombre_caja != null)
                                        @if ($c->id == $this->id_caja)
                                            <button type="button"
                                                onclick="ConfirmarCerrar({{ $c->id }},'{{ $c->nombre }}')"
                                                class="btn btn-danger">
                                                <i class="fas fa-arrow-right"></i>
                                                Cerrar Sesion
                                            </button>
                                        @else
                                            @if ($c->misucursal)
                                                <p>
                                                    <b>Para usar esta caja cierre la caja "{{ $this->nombre_caja }}"</b>
                                                </p>
                                            @endif
                                        @endif
                                    @else
                                        <button
                                            onclick="ConfirmarCerrarUsuario({{ $c->id }},'{{ $c->nombre }}','{{ $c->abiertapor }}')"
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
                                            <button wire:click.prevent="confirmarAbrir({{ $c->id }})"
                                                class="btn btn-primary">
                                                <i class="fas fa-arrow-up"></i>

                                                Abrir Caja

                                            </button>
                                        @endif
                                    @endif


                                @endif

                            </div>
                        @else
                            <div class="connect-sorting text-center">
                                <br>
                                <br>
                                <p class="h1">Esta caja no tiene carteras</p>
                                <br>
                                <br>
                                <br>
                            </div>

                        @endif

                    </div>
                    <br>
                </div>
            </div>

        @endforeach

    </div>
    @include('livewire.cortecaja.ajusteCajaEfectiva')
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
                })
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
                })
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

 
        function ConfirmarCerrar(id, nombrecaja) {
            swal({
                title: '¿Cerrar esta Caja?',
                text: "Se realizará el cierre de la caja: " + nombrecaja,
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('cerrar-caja', id)
                }
            })
        }
        // Código para lanzar la Alerta de Confirmación para cerrar una caja abierta por otro usuario
        function ConfirmarCerrarUsuario(id, nombrecaja, nombreusuario) {
            swal({
                title: '¿Cerrar la Caja abierta por ' + nombreusuario + '?',
                text: "Se realizará el cierre de la caja: " + nombrecaja,
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('cerrar-caja-usuario', id)
                }
            })
        }
    </script>
@endsection