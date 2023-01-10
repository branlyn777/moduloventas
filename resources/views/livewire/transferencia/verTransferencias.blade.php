@section('migaspan')
      <nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
				<li class="breadcrumb-item text-sm">
					<a class="text-white" href="javascript:;">
						<i class="ni ni-box-2"></i>
					</a>
				</li>
				<li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
						href="{{url("")}}">Inicio</a></li>
				<li class="breadcrumb-item text-sm text-white active" aria-current="page">Inventarios</li>
			</ol>
			<h6 class="font-weight-bolder mb-0 text-white">Transferencias</h6>
		</nav> 
@endsection


@section('Gestionproductoscollapse')
nav-link
@endsection


@section('Gestionproductosarrow')
true
@endsection


@section('tranferenciasnav')
"nav-link active"
@endsection


@section('Gestionproductosshow')
"collapse show"
@endsection

@section('tranferenciasli')
"nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">
           
                <div class="d-lg-flex my-auto p-0 mb-3">
                    <div>
                        <h5 class=" text-white" style="font-size: 16px">Lista Transferencias</h5>
                    </div>

                    <div class="ms-auto my-auto mt-lg-1">
                        <div class="ms-auto my-auto">
                            <a href="transferencia" class="btn btn-secondary" type="button">
                                <span class="btn-inner--text">Transferir Productos</span>
                                <span class="btn-inner--icon"><i class="fas fa-arrow-right"></i></span>
                            </a>

                            {{-- <a href="transferencia" class="btn btn-add btn-sm mb-0"> Transferir Productos <i class="fas fa-arrow-right"></i></a> --}}
                        </div>
                    </div>
                </div>
            
            <div class="card">
                <div class="card-body">

                    <div class="col-md-12 px-10 col-sm-12">

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
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane {{ $show1 }} {{ $estado_lista_tr }}" wire:click="$set('show2','')"
                            wire:click="$set('$estado_lista_tr','active')" id="listar-transferencias" role="tabpanel">
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 6%">N°</th>
                                                <th class="text-center">Codigo Transf.</th>
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
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <button type="button" class="btn btn-primary"
                                                                    onclick="Confirm({{ $data_td->t_id }})"
                                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                                    title="Editar">
                                                                    <i class="fas fa-edit" style="font-size: 14px"></i>
                                                                </button>

                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="Confirmarborrado('{{ $data_td->t_id }}')"
                                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                                    title="Eliminar">
                                                                    <i class="fas fa-trash text-white" style="font-size: 14px"></i>
                                                                </button>

                                                                <button type="button" class="btn btn-secondary" wire:key="do"
                                                                    wire:click="ver({{ $data_td->t_id }})" class="p-1 m-0"
                                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                                    title="Ver">
                                                                    <i class="fas fa-list text-white" style="font-size: 14px"></i>
                                                                </button>
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
        </div>
    </div>
    @include('livewire.transferencia.modaldetalletr')
    @include('livewire.transferencia.modaldetallete')
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
