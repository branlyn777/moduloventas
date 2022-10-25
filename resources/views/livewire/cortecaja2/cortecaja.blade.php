<div>
    <div class="row">
        <div class="col-12 text-center">
          <p class="h1"><b>CAJAS DISPONIBLES EN TU SUCURSAL</b></p>
          <p>Seleccione la caja en la cual va a trabajar</p>
        </div>
      </div>
  
      <div class="row">
        <div class="col-12 col-sm-12 col-md-3 text-right">
            
        </div>
        <div class="col-12 col-sm-12 col-md-3 text-center">
            <b>Sucursal</b>
            <select class="form-control" name="" id="">
                <option value="">
                    sdgsdg
                </option>
            </select>
        </div>

        <div class="col-12 col-sm-12 col-md-3 text-center">
            <b style="color: white">|</b>
            <button wire:click.prevent="" class="boton-azul-g form-control">
                {{$caja_especial->nombre}}
            </button>
        </div>

        <div class="col-12 col-sm-12 col-md-3 text-right">
            
        </div>
  
      </div>

      <br>

      <div class="row">





        @foreach($cajas as $c)
            <div class="col-sm-12 col-md-6">
                <div class="form-group" style="background-color: rgb(191, 255, 200);">
                    <div class="connect-sorting text-center">
                        <p class="h1"><b>{{$c->nombre}}</b></p>
                    </div>
                    <p class="h3"><b>ESTADO:</b> {{$c->estado}} </p>
                    <p class="h3"><b>ABIERTA POR:</b></p>
                    <p class="h3"><b>SUCURSAL:</b> {{$c->nombresucursal}} - {{$c->nombresucursal}}</p>

                    <div class="connect-sorting text-center">
                        <button onclick="Confirmar({{$c->id}},'{{$c->nombre}}')" class="boton-azul-g">
                            CORTE DE CAJA
                        </button>
                    </div>

                </div>
            </div>
        @endforeach



      </div>


</div>

@section('javascript')





<script>
    document.addEventListener('DOMContentLoaded', function() {
        

        //
        window.livewire.on('modalcambiarusuario-hide', msg => {
            

            
        });
    });












    // Código para lanzar la Alerta de Confirmación
    function Confirmar(id, nombrecaja) {
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


</script>
@endsection