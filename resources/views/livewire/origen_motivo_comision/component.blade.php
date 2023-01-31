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
    <h6 class="font-weight-bolder mb-0 text-white">Origen Motivo Comision</h6>
</nav>
@endsection


@section('tigocollapse')
nav-link
@endsection


@section('tigoarrow')
true
@endsection


@section('origenmotcomnav')
"nav-link active"
@endsection


@section('tigoshow')
"collapse show"
@endsection

@section('origenmotcomli')
"nav-item active"
@endsection

<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">{{ $componentName }}</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        {{-- <a class="btn btn-add mb-0" wire:click="resetUI()" data-bs-toggle="modal"  data-bs-target="#theModalCategory">
                            <i class="fas fa-plus"></i> Agregar Categoría</a> --}}
                    </div>
                </div>

            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="row">

                        <div class="col-3">
                            <div class="form-group mr-5">
                                <select wire:model="tipo" class="form-select">
                                    <option value="Elegir" selected>==Seleccione el tipo==</option>
                                    <option>Propia</option>
                                    <option>Cliente</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group mr-5">
                                <select wire:model="origen" class="form-select">
                                    <option value="Elegir" disabled>==Seleccione el Origen==</option>
                                    @foreach($origenes as $origen)
                                    <option value="{{$origen->id}}">{{$origen->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            @if($motivos !="Elegir")
                            <div class="form-group mr-5">
                                <select wire:model="motivo" class="form-select">
                                    <option value="Elegir" disabled>==Seleccione el motivo==</option>
                                    @foreach($motivos as  $mot)
                                    <option value="{{$mot->id}}">{{$mot->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>

                        

                        

                        

                        
                        
                        {{-- <button onclick="Revocar()" type="button" class="btn btn-warning mbmobile mr-5">Revocar todos</button> --}}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm ps-2">NOMBRE COMISION</th>
                                    <th class="text-uppercase text-sm ps-2">M INICIAL</th>
                                    <th class="text-uppercase text-sm ps-2">M FINAL</th>
                                    <th class="text-uppercase text-sm ps-2">COMISION</th>
                                    <th class="text-uppercase text-sm ps-2">PORCENTAJE</th>
                            </thead>
                            <tbody>
                                @foreach ($comisiones as $comi)
                                <tr>
                                    <td class="text-sm mb-0">
                                        <div class="">



                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                type="checkbox" 
                                                wire:change="SyncPermiso($('#p' + {{ $comi->id 
                                                    }}).is(':checked'), '{{$comi->id}}')"
                                                    id="p{{ $comi->id }}"
                                                    value="{{ $comi->id }}"
                                                {{ $comi->checked == 1 ? 'checked' : '' }}
                                                >
                                                <label class="custom-control-label" for="customCheck1">{{ $comi->nombre}}</label>
                                              </div>



                                            {{-- <input type="checkbox" 
                                            wire:change="SyncPermiso($('#p' + {{ $comi->id 
                                                }}).is(':checked'), '{{$comi->id}}')"
                                                id="p{{ $comi->id }}"
                                                value="{{ $comi->id }}"
                                            class="new-control-input" 
                                            {{ $comi->checked == 1 ? 'checked' : '' }}
                                            >
                                            <span class="new-control-indicator"></span>
                                            {{ $comi->nombre}} --}}
                                        </div>
                                    </td>
                                    <td class="text-sm mb-0">
                                        {{$comi->monto_inicial}}
                                    </td>
                                    <td class="text-sm mb-0">
                                        {{$comi->monto_final}}
                                    </td>
                                    <td class="text-sm mb-0">
                                        {{$comi->comision}}
                                    </td>
                                    <td class="text-sm mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="{{$comi->porcentaje == 'Activo' ? 'color: #29a727':'color: #f50707'}}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-{{$comi->porcentaje == 'Activo' ? 'right':'left'}}"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="{{$comi->porcentaje == 'Activo' ? '16':'8'}}" cy="12" r="3"></circle></svg>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $comisiones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {


        window.livewire.on('sync-error', Msg => {
            noty(Msg)
        });
        window.livewire.on('permi', Msg => {
            noty(Msg)
        });
        window.livewire.on('syncall', Msg => {
            noty(Msg)
        });
        window.livewire.on('removeall', Msg => {
            noty(Msg)
        });
        window.livewire.on('no_sincronizar', Msg => {
            noty(Msg)
        });
    });

    /* function Revocar() {

        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmas revocar todos las comisiones?',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('revokeall')
                Swal.close()
            }
        })
    } */
</script>