@section('css')
<style>
    .cajaabierta{
        background-color: rgb(158, 239, 250);
        padding: 10px;
        border-radius: 15px;
        border: #0ed1df solid 2px;
    }

    .cajacerrada{
        background-color: rgb(255, 255, 255);
        padding: 10px;
        border-radius: 15px;
        border: #000000 solid 2px;
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

        <div class="col-12 col-sm-3 col-md-4 text-center">
            {{-- <b style="color: white">|</b>
            <button wire:click.prevent="" class="boton-azul-g form-control">
                Ver Carteras Compartidas
            </button> --}}
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            
        </div>
  
      </div>

      <br>

      <div class="row">





        @foreach($cajas as $c)
            <div class="col-sm-12 col-md-4">
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
                            <div class="col-12 col-sm-12 col-md-10 text-center">
                                <div style="background-color: rgb(225, 242, 255); padding: 12px; border-radius: 15px;">

                                    {{-- Cargando todas las carteras compartidas --}}
                                    @foreach($carteras_generales as $cg)
                                    <div style="padding-bottom: 3px;">
                                        <span class="stamp stamp" style="background-color: #1b7488; font-size: 20px; border-radius: 5px;">
                                            {{$cg->nombrecartera}}:
                                        </span>
                                        <span class="stamp stamp" style="background-color: #00969b; font-size: 20px; border-radius: 5px;">
                                            {{$cg->saldocartera}} Bs
                                        </span>
                                    </div>
                                    @endforeach


                                    {{-- Cargando todas las carteras de la caja --}}
                                    @foreach($c->carteras as $car)
                                    <div style="padding-bottom: 3px;">
                                        <span class="stamp stamp" style="background-color: #2c2d2e; font-size: 20px; border-radius: 5px;">
                                            {{$car->nombre}}:
                                        </span>
                                        <span class="stamp stamp" style="background-color: #5e7074; font-size: 20px; border-radius: 5px;">
                                            {{$car->saldocartera}} Bs
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
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
            title: 'Caja Cerrada',
            text: "Un usuario ya cerro la Caja seleccionada antes que usted lo haga",
            type: 'info',
            showCancelButton: false,
            cancelButtonText: 'Aceptar',
            footer: '<a href="cortecajas2">Recargue la Pagina</a>',
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