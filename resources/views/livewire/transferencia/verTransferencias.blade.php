<div>
    <div class="card mb-4">
     
            <div class="row">
                <div class="col-md-12 p-3 px-4">
                    <h6>Lista Transferencias</h6>
                </div>

                <div class="card-body p-3">

                <div class="d-flex flex-row-reverse m-2">
                    <a href="transferencia" class="btn btn-primary"> Transferir Productos <i
                            class="fas fa-arrow-right"></i></a>
                </div>

                <div class="col-md-12 px-10">

                    <div class="nav-wrapper position-relative">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab"
                                    href="#listar-transferencias" role="tab" aria-controls="listar-transferencias"
                                    aria-selected="true">
                                    Listar Transferencias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                    href="#listar-transferencias-pendientes" role="tab"
                                    aria-controls="listar-transferencias-pendientes" aria-selected="false">
                                    Transferencias Entrantes
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
             
                <div class="tab-content">

                    <div class="tab-pane {{ $show1 }} {{ $estado_lista_tr }}" wire:click="$set('show2','')"
                        wire:click="$set('$estado_lista_tr','active')" id="listar-transferencias" role="tabpanel">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 6%">N°</th>
                                            <th class="text-center">Codigo <br> Transf.</th>
                                            {{-- <th class="text-center">DETALLE</th> --}}
                                            <th class="text-left">Estado</th>
                                            <th class="text-left">Usuario</th>
                                            <th class="text-center">Acc.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_t as $data_td)
                                            <tr>
                                                <td>
                                                    <h6 class="text-center">{{ $nro++ }}</h6>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-gradient-info">{{ $data_td->t_id }}</span>

                                                </td>
                                                {{-- <td>
                                                <h6 class="text-left"> <strong>Fecha:</strong> {{
                                                    \Carbon\Carbon::parse($data_td->fecha_tr)->format('Y-m-d')}}</h6>
                                                <h6 class="text-left"> <strong>Hora:</strong> {{
                                                    \Carbon\Carbon::parse($data_td->fecha_tr)->format('H:i')}}</h6>
                                                <h6 class="text-left"> <strong>Origen:</strong> {{
                                                    $data_td->origen}}-{{$data_td->origen_name}}</h6>
                                                <h6 class="text-left"> <strong>Destino:</strong> {{ $data_td->dst
                                                    }}-{{$data_td->destino_name}}</h6>
    
                                            </td> --}}

                                                @if ($data_td->estado_tr == 'En transito')
                                                    <td>
                                                        <h6 class="text-left">{{ $data_td->estado_tr }}</h6>
                                                    </td>
                                                @elseif($data_td->estado_tr == 'Recibido')
                                                    <td>
                                                        <h6 class="text-left">{{ $data_td->estado_tr }}</h6>
                                                    </td>
                                                @else
                                                    <td>
                                                        <h6 class="text-left">{{ $data_td->estado_tr }}</h6>
                                                    </td>
                                                @endif

                                                <td>
                                                    <h6 class="text-left">{{ $data_td->name }}</h6>
                                                </td>

                                                @if ($data_td->estado_tr == 'Recibido' or $data_td->estado_tr == 'Rechazado' or !in_array($data_td->orih, $vs))
                                                    <td class="text-center">


                                                        <a href="javascript:void(0)" wire:key="foo"
                                                            wire:click="ver({{ $data_td->t_id }})" class="p-1 m-0"
                                                            title="Ver">
                                                            <i class="fas fa-list"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            wire:click="imprimir(  {{ $data_td->t_id }})"
                                                            class="boton-verde p-1 m-0" title="Imprimir">
                                                            <i class="fas fa-print"></i>
                                                        </a>



                                                    </td>
                                                @else
                                                    <td class="text-center">

                                                        <a href="javascript:void(0)"
                                                            onclick="Confirm({{ $data_td->t_id }})"
                                                            class="text-secondary p-1 m-0" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <a href="javascript:void(0)"
                                                            onclick="Confirmarborrado('{{ $data_td->t_id }}')"
                                                            class="text-danger p-1 m-0" title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" wire:key="do"
                                                            wire:click="ver({{ $data_td->t_id }})" class="p-1 m-0"
                                                            title="Ver">
                                                            <i class="fas fa-list"></i>
                                                        </a>

                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane  {{ $show2 }} {{ $estado_lista_te }}"
                        id="listar-transferencias-pendientes" wire:click="$set('show1', '')"
                        wire:click="$set('$estado_lista_tr','active')" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 6%">N°</th>
                                        <th class="text-center">Codigo <br> Transf.</th>
                                        {{-- <th class="text-center">DETALLE</th> --}}
                                        <th class="text-left">Estado</th>
                                        <th class="text-left">Usuario</th>
                                        <th class="text-center">Acc.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_d as $data2)
                                        <tr>
                                            <td>
                                                <h6 class="text-center">{{ $nro++ }}</h6>
                                            </td>
                                            <td class="text-center">
                                           
                                                <span class="badge bg-gradient-info">{{ $data2->tr_des_id }}</span>
                                            </td>
                                            {{-- <td>
                                                <h6 class="text-left"> <strong>Fecha:</strong>
                                                    {{ \Carbon\Carbon::parse($data2->fecha_tr)->format('Y-m-d') }}</h6>
                                                <h6 class="text-left"> <strong>Hora:</strong>
                                                    {{ \Carbon\Carbon::parse($data2->fecha_tr)->format('H:i') }}</h6>
                                                <h6 class="text-left"> <strong>Origen:</strong>
                                                    {{ $data2->origen }}-{{ $data2->origen_name }}</h6>
                                                <h6 class="text-left"> <strong>Destino:</strong>
                                                    {{ $data2->dst2 }}-{{ $data2->destino_name }}</h6>

                                            </td> --}}


                                            @if ($data2->estado_te == 'En transito')
                                                <td>
                                                    <h6 class="text-left">{{ $data2->estado_te }}</h6>
                                                </td>
                                            @elseif($data2->estado_te == 'Recibido')
                                                <td>
                                                    <h6 class="text-left">{{ $data2->estado_te }}</h6>
                                                </td>
                                            @else
                                                <td>
                                                    <h6 class="text-left">{{ $data2->estado_te }}</h6>
                                                </td>
                                            @endif

                                            <td>
                                                <h6 class="text-left">{{ $data2->name }}</h6>
                                            </td>

                                            <td class="text-center">
                                                @if ($data2->estado_te === 'Recibido' or $data2->estado_te === 'Rechazado')
                                                    <a href="javascript:void(0)"
                                                        wire:click="visualizardestino({{ $data2->tr_des_id }})"
                                                        class="boton-azul p-1 m-0" title="Ver">
                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        wire:click="imprimir({{ $data2->tr_des_id }})"
                                                        class="boton-verde p-1 m-0" title="Imprimir">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        wire:click="visualizardestino({{ $data2->tr_des_id }})"
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

            </div>
        
        @include('livewire.transferencia.modaldetalletr')
        @include('livewire.transferencia.modaldetallete')
    </div>

</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
