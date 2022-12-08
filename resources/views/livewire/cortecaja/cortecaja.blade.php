@section('css')
<style>
    .cajaabierta {
        background-color: rgb(255, 255, 255);
        padding: 10px;
        border-radius: 15px;
 
        box-shadow: 3px 3px #5ea8e48c;
    }

    .cajacerrada {
        background-color: rgb(255, 253, 253);
        padding: 10px;
        border-radius: 15px;
        box-shadow: 3px 3px #8888889f;

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

<div class="container-fluid my-5 py-2">
    <div class="row mt-n6">
        <div class="col-12 text-left text-white">
            <p class="h5 text-white"><b>CAJAS DISPONIBLES EN TU SUCURSAL</b></p>
            <p>Seleccione la caja en la cual va a trabajar</p>
        </div>
    </div>

    <div class="row justify-content-start">

        <div class="col-12 col-sm-6 col-md-4 text-left">
            <b class="text-white">Sucursal</b>
            <select wire:model="idsucursal" class="form-control" name="" id="">
                @foreach($sucursales as $s)
                <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
                <option value="Todos">Todas las Sucursales</option>
            </select>
        </div>

        <div class="col-12 col-sm-2 col-md-2 text-center">
            <b style="color: rgba(255, 255, 255, 0)">|</b>
            <button wire:click.prevent="cerrartodo()" class="boton-azul-g form-control">
                Cerrar Todo
            </button>
        </div>
        <div class="col-12 col-sm-2 col-md-2 text-center">
            <b style="color: rgba(255, 255, 255, 0)">|</b>
            <button wire:click.prevent="ajustarcarteras()" class="boton-azul-g form-control">
                Ajustar
            </button>
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-right">

        </div>

    </div>

    <br>


    <center>
        <div id="preloader_3" wire:loading>
            <div class="lds-roller">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </center>
    <div class="row">
        @foreach($cajas as $c)
        <div class="col-12 col-sm-6 col-md-3">
            <div class="{{ $c->estado == 'Abierto' ? 'cajaabierta' : 'cajacerrada' }}">
                <div class="connect-sorting text-left">
                    <h5> <b>{{$c->nombre}}</b> </h5>
                    <br>
                    <b>Sucursal:</b> {{$c->nombresucursal}}
                </div>
                @if($c->carteras->count() > 0 || $carteras_generales->count() > 0)

                <div class="connect-sorting text-left">
                    <b>Abierta por:</b> {{$c->abiertapor}}
                </div>
                <br>
                <div class="connect-sorting text-center">

                    @if($c->estado == "Abierto")

                    @if($this->nombre_caja != null)

                    @if($c->id == $this->id_caja)
                    <button type="button" onclick="ConfirmarCerrar({{$c->id}},'{{$c->nombre}}')" class="btn btn-success">
                        <i class="fas fa-arrow-right"></i>
                        Cerrar Sesion
                    </button>
                    @else
                    @if($c->misucursal)
                    <p>
                        <b>Para usar esta caja cierre la caja "{{$this->nombre_caja}}"</b>
                    </p>
                    @endif
                    @endif


                    @else
                    <button onclick="ConfirmarCerrarUsuario({{$c->id}},'{{$c->nombre}}','{{$c->abiertapor}}')"
                        class="btn btn-primary">
                        CERRAR CAJA DE OTRO USUARIO
                    </button>
                    @endif


                    @else


                    @if($this->nombre_caja != null)
                    @if($c->misucursal)
                    <p>
                        <b>Para usar esta caja cierre la caja "{{$this->nombre_caja}}"</b>
                    </p>
                    @endif

                    @else


                    @if($c->misucursal)
                    <button onclick="ConfirmarAbrir({{$c->id}},'{{$c->nombre}}')" class="btn btn-secondary">
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
        @endforeach

    </div>
    @include('livewire.cortecaja.ajusteCajaEfectiva')
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
    });

    // Código para lanzar la Alerta de Confirmación
    function ConfirmarAbrir(id, nombrecaja)
    {
        swal({
        title: '¿Realizar Corte de Caja?',
        text: "Realizará la apertura de la caja: " + nombrecaja + " y se habilitarán todas las carteras de esta",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Aceptar',
        padding: '2em'
        }).then(function(result) {
        if (result.value) {
            window.livewire.emit('corte-caja', id)
            }
        })
    }
    // Código para lanzar la Alerta de Confirmación
    function ConfirmarCerrar(id, nombrecaja)
    {
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
    function ConfirmarCerrarUsuario(id, nombrecaja, nombreusuario)
    {
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