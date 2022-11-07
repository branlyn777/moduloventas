@section('css')
<style>
    .cajaabierta{
        background-color: rgb(169, 245, 255);
        padding: 10px;
        border-radius: 15px;
        border: #000000 solid 2px;
    }

    .cajacerrada{
        background-color: rgb(255, 255, 255);
        padding: 10px;
        border-radius: 15px;
        border: #000000 solid 2px;
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
    <div class="row">
        <div class="col-12 text-center">
          <p class="h1"><b>CAJAS DISPONIBLES EN TU SUCURSAL</b></p>
          <p>Seleccione la caja en la cual va a trabajar</p>
        </div>
    </div>
  
    <div class="row">
    <div class="col-12 col-sm-3 col-md-4 text-right">
        
    </div>
    <div class="col-12 col-sm-6 col-md-4 text-center">
        <b>Sucursal</b>
        <select wire:model="idsucursal" class="form-control" name="" id="">
            @foreach($sucursales as $s)
            <option value="{{$s->id}}">{{$s->name}}</option>
            @endforeach
            <option value="Todos">Todas las Sucursales</option>
        </select>
    </div>

    <div class="col-12 col-sm-2 col-md-2 text-center">
        <b style="color: white">|</b>
        <button wire:click.prevent="cerrartodo()" class="boton-azul-g form-control">
            Cerrar Todo
        </button>
    </div>
    <div class="col-12 col-sm-2 col-md-2 text-center">
        <b style="color: white">|</b>
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
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        </center>






      <div class="row">





        @foreach($cajas as $c)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="{{ $c->estado == 'Abierto' ? 'cajaabierta' : 'cajacerrada' }}">
                    <div class="connect-sorting text-center">
                        <b class="h1">{{$c->nombre}}</b>
                        <br>
                        SUCURSAL:</b> {{$c->nombresucursal}} - {{$c->nombresucursal}}
                        
                    </div>

                    @if($c->carteras->count() > 0)

                        <div class="text-center">
                            <p class="h4"><b>Abierta por: {{$c->abiertapor}}</b></p>
                        </div>

                        <div class="row">

                            <div class="col-12 col-sm-12 col-md-1 text-center">
                                
                            </div>
                            <div class="col-12 col-sm-12 col-md-10">



                                <div class="table-1">
                                    <table>
                                        <tbody>
                                            @foreach($carteras_generales as $cg)
                                            <tr>
                                                <td class="text-right">
                                                    <span class="stamp stamp" style="background-color: #1b7488; font-size: 20px; border-radius: 5px;">
                                                        {{ucwords(strtolower($cg->nombrecartera))}}
                                                    </span> :
                                                </td>
                                                <td class="text-right">
                                                    <span class="stamp stamp" style="background-color: #00969b; font-size: 20px; border-radius: 5px;">
                                                        {{ number_format($cg->saldocartera, 2, ",", ".")}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="stamp stamp" style="background-color: #00969b; font-size: 20px; border-radius: 5px;">
                                                        Bs
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach

                                            @foreach($c->carteras as $car)
                                            <tr>
                                                <td class="text-right">
                                                    <span class="stamp stamp" style="background-color: #2c2d2e; font-size: 20px; border-radius: 5px;">
                                                        {{ucwords(strtolower($car->nombre))}}
                                                    </span> :
                                                </td>
                                                <td class="text-right">
                                                    <span class="stamp stamp" style="background-color: #5e7074; font-size: 20px; border-radius: 5px;">
                                                        {{number_format($car->saldocartera, 2, ",", ".")}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="stamp stamp" style="background-color: #5e7074; font-size: 20px; border-radius: 5px;">
                                                        Bs
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>








                                {{-- <div style="background-color: rgb(225, 242, 255); padding: 12px; border-radius: 15px;">
                                    @foreach($carteras_generales as $cg)
                                    <div style="padding-bottom: 3px;">
                                        <span class="stamp stamp" style="background-color: #1b7488; font-size: 20px; border-radius: 5px;">
                                            {{ucwords(strtolower($cg->nombrecartera))}}:
                                        </span>
                                        <span class="stamp stamp" style="background-color: #00969b; font-size: 20px; border-radius: 5px;">
                                            {{$cg->saldocartera}} Bs
                                        </span>
                                    </div>
                                    @endforeach
                                    @foreach($c->carteras as $car)
                                    <div style="padding-bottom: 3px;">
                                        <span class="stamp stamp" style="background-color: #2c2d2e; font-size: 20px; border-radius: 5px;">
                                            {{ucwords(strtolower($car->nombre))}}:
                                        </span>
                                        <span class="stamp stamp" style="background-color: #5e7074; font-size: 20px; border-radius: 5px;">
                                            {{$car->saldocartera}} Bs
                                        </span>
                                    </div>
                                    @endforeach
                                </div> --}}
                            </div>
                            <div class="col-12 col-sm-12 col-md-1 text-center">
                                
                            </div>
                        </div>

                        <br>




                        <div class="connect-sorting text-center">

                           @if($c->estado == "Abierto")

                                @if($this->nombre_caja != null)
                                
                                    @if($c->id == $this->id_caja)
                                        <button onclick="ConfirmarCerrar({{$c->id}},'{{$c->nombre}}')" class="boton-azul-g">
                                            CERRAR CAJA
                                        </button>
                                    @else
                                        @if($c->misucursal)
                                            <p>
                                                <b>Para usar esta caja cierre la caja "{{$this->nombre_caja}}"</b>
                                            </p>
                                        @endif
                                    @endif


                                @else
                                    <button onclick="ConfirmarCerrarUsuario({{$c->id}},'{{$c->nombre}}','{{$c->abiertapor}}')" class="boton-azul-g">
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
                                        <button onclick="ConfirmarAbrir({{$c->id}},'{{$c->nombre}}')" class="boton-plomo-g">
                                            CORTE DE CAJA
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