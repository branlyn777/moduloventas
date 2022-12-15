<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista Transferencias</h6>
                  </div>
        
                <div class="d-flex flex-row-reverse m-2">
                    <a href="transferencia" class="btn btn-primary">  Transferir Productos <i class="fas fa-arrow-right" ></i></a>
                </div>

<div class="col-md-6  m-2">

    <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills nav-fill p-1" role="tablist">
           <li class="nav-item">
              <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="listar-transferencias" href="#listar-transferencias" role="tab" aria-controls="listar-transferencias" aria-selected="true">
                Listar Transferencias
              </a>
           </li>
           <li class="nav-item">
              <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="listar-transferencias-pendientes" href="#listar-transferencias-pendientes" role="tab" aria-controls="listar-transferencias-pendientes" aria-selected="false">
                Transferencias Entrantes
              </a>
           </li>
         </ul>
     </div>
</div>
{{-- 

                <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link true" id="listar-transferencias" data-toggle="pill" href="#pills-tr"
                            role="tab" aria-controls="pills-tr" aria-selected="true"> <i class="fas fa-list"></i>
                            Listar Transferencias
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="listar-transferencias-pendientes" data-toggle="pill"
                            href="#pills-tr-apr" role="tab" aria-controls="pills-tr-apr" aria-selected="true"> <i
                                class="fas fa-arrow-circle-right"></i>
                            Transferencias Entrantes</a>
                    </li>

                </ul> --}}
         
                    <div class=" {{$show1}} {{$estado_lista_tr}}" wire:click="$set('show2','')"
                        wire:click="$set('$estado_lista_tr','active')" id="listar-transferencias" role="tabpanel">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%" class="text-center">#</th>
                                            <th class="text-center">COD.</th>
                                            <th class="text-center">DETALLE</th>
                                            <th class="text-center">ESTADO</th>
                                            <th class="text-center">USUARIO</th>
                                            <th class="text-center">ACC.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_t as $data_td)
                                        <tr>
                                            <td>
                                                <h6 class="text-center">{{ $nro++ }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="text-center">{{ $data_td->t_id }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="text-left"> <strong>Fecha:</strong> {{
                                                    \Carbon\Carbon::parse($data_td->fecha_tr)->format('Y-m-d')}}</h6>
                                                <h6 class="text-left"> <strong>Hora:</strong> {{
                                                    \Carbon\Carbon::parse($data_td->fecha_tr)->format('H:i')}}</h6>
                                                <h6 class="text-left"> <strong>Origen:</strong> {{
                                                    $data_td->origen}}-{{$data_td->origen_name}}</h6>
                                                <h6 class="text-left"> <strong>Destino:</strong> {{ $data_td->dst
                                                    }}-{{$data_td->destino_name}}</h6>
    
                                            </td>
    
                                            @if($data_td->estado_tr =="En transito")
                                            <td>
                                                <h6 class="text-center">{{ $data_td->estado_tr }}</h6>
                                            </td>
    
                                            @elseif($data_td->estado_tr =="Recibido")
                                            <td>
                                                <h6 class="text-center">{{ $data_td->estado_tr }}</h6>
                                            </td>
    
                                            @else
                                            <td>
                                                <h6 class="text-center">{{ $data_td->estado_tr }}</h6>
                                            </td>
    
                                            @endif
    
                                            <td>
                                                <h6 class="text-center">{{ $data_td->name }}</h6>
                                            </td>
    
                                            @if ($data_td->estado_tr =='Recibido' or $data_td->estado_tr =='Rechazado'
                                            or !(in_array($data_td->orih, $vs)))
                                            <td>
                                                <div class="row justify-content-center">
    
                                                    <a href="javascript:void(0)" wire:key="foo"
                                                        wire:click="ver({{$data_td->t_id}})" class="boton-azul p-1 m-0"
                                                        title="Ver">
                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" wire:click="imprimir({{$data_td->t_id}})"
                                                        class="boton-verde p-1 m-0" title="Imprimir">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </div>
    
    
                                            </td>
                                            @else
                                            <td>
                                                <div class="row justify-content-center">
                                                    <a href="javascript:void(0)" onclick="Confirm({{$data_td->t_id}})"
                                                        class="boton-celeste p-1 m-0" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
    
                                                    <a href="javascript:void(0)"
                                                        onclick="Confirmarborrado('{{ $data_td->t_id }}')"
                                                        class="boton-rojo p-1 m-0" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
    
                                                    <a href="javascript:void(0)" wire:key="do"
                                                        wire:click="ver({{$data_td->t_id}})" class="boton-azul p-1 m-0"
                                                        title="Ver">
                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
    
                            </div>
                        </div>
                    </div>
                    <div class=" {{$show2}} {{$estado_lista_te}}" id="listar-transferencias-pendientes"
                        wire:click="$set('show1', '')" wire:click="$set('$estado_lista_tr','active')" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Cod</th>
                                        <th class="text-center">Transferencia</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">ddsd</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_d as $data2)
                                    <tr>
                                        <td>
                                            <h6 class="text-center">{{ $nro++ }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center">{{ $data2->t_id }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left"> <strong>Fecha:</strong> {{
                                                \Carbon\Carbon::parse($data2->fecha_tr)->format('Y-m-d')}}</h6>
                                            <h6 class="text-left"> <strong>Hora:</strong> {{
                                                \Carbon\Carbon::parse($data2->fecha_tr)->format('H:i')}}</h6>
                                            <h6 class="text-left"> <strong>Origen:</strong> {{
                                                $data2->origen}}-{{$data2->origen_name}}</h6>
                                            <h6 class="text-left"> <strong>Destino:</strong> {{ $data2->dst2
                                                }}-{{$data2->destino_name}}</h6>

                                        </td>


                                        @if($data2->estado_te =="En transito")
                                        <td>
                                            <h6 class="text-center">{{ $data2->estado_te }}</h6>
                                        </td>

                                        @elseif($data2->estado_te =="Recibido")
                                        <td>
                                            <h6 class="text-center">{{ $data2->estado_te }}</h6>
                                        </td>

                                        @else
                                        <td>
                                            <h6 class="text-center">{{ $data2->estado_te }}</h6>
                                        </td>

                                        @endif

                                        <td>
                                            <h6 class="text-center">{{ $data2->name }}</h6>
                                        </td>

                                        <td class="text-center">
                                            @if ($data2->estado_te ==='Recibido' or $data2->estado_te ===
                                            'Rechazado')
                                            <a href="javascript:void(0)"
                                                wire:click="visualizardestino({{$data2->tr_des_id}})"
                                                class="boton-azul p-1 m-0" title="Ver">
                                                <i class="fas fa-list"></i>
                                            </a>
                                            <a href="javascript:void(0)" wire:click="imprimir({{$data2->tr_des_id}})"
                                                class="boton-verde p-1 m-0" title="Imprimir">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            @else

                                            <a href="javascript:void(0)"
                                                wire:click="visualizardestino({{$data2->tr_des_id}})"
                                                class="boton-azul p-1 m-0" title="Ver">
                                                <i class="fas fa-list"></i>
                                            </a>

                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>




             
            </div>
        </div>
        @include('livewire.transferencia.modaldetalletr')
        @include('livewire.transferencia.modaldetallete')
    </div>

</div>
@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() 
    {
        window.livewire.on('show1', msg => {
            $('#detailtranference').modal('show')
        });  

        window.livewire.on('show2', msg => {
            $('#detailtranferencete').modal('show')
        });  
        window.livewire.on('close2', msg => {
            $('#detailtranferencete').modal('hide')
        });  

        window.livewire.on('opentap', Msg => {
         
            var win = window.open('Transferencia/pdf');
            // Cambiar el foco al nuevo tab (punto opcional)
            // win.focus();

        });

        window.livewire.on('transferencia_eliminada', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
    });
    function Confirm(id) {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Esta seguro de editar la transferencia?',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('editRow', id)
                Swal.close()
            }
        })
    }
    function Confirmarborrado(id) {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Esta seguro de eliminar la transferencia?',
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

</script>

@endsection