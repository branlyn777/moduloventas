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
    <h6 class="font-weight-bolder mb-0 text-white">Arqueos Tigo
</nav>
@endsection


@section('tigocollapse')
nav-link
@endsection


@section('tigoarrow')
true
@endsection


@section('arqueonav')
"nav-link active"
@endsection


@section('tigoshow')
"collapse show"
@endsection

@section('arquetigoli')
"nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Arqueos Tigo Money</h5>
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
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <h6>Usuario</h6>
                                <select wire:model="userid" class="form-select">
                                    <option value="0" disabled>Elegir</option>
                                    @foreach($users as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                    @endforeach
                                </select>
                                @error('userid')
                                <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <h6>Fecha inicial</h6>
                                <input type="date" wire:model.lazy="fromDate" class="form-control">
                                @error('fromDate')
                                <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <h6>Fecha final</h6>
                                <input type="date" wire:model.lazy="toDate" class="form-control">
                                @error('toDate')
                                <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <h6>Origen</h6>
                                <select wire:model="origenfiltro" class="form-select">
                                    <option value="0" selected>Todas</option>
                                        <option value="Sistema">Sistema</option>
                                        <option value="Telefono">Telefono</option>                                
                                </select>
                            </div>
                        </div>
    
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <h6>Tipo de transacción</h6>
                                <select wire:model="tipotr" class="form-select">
                                    <option value="0" selected>Todas</option>
                                        <option value="Retiro">Retiro</option>
                                        <option value="Abono">Abono</option> 
                                </select>
                                @error('tipotr')
                                <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-control bg-primary">
                                <h5 class="text-white">Transacciones Totales : <br> ${{number_format($total,2)}}</h5>
                            </div>           
                        </div>
                        <div class="col-9">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="">
                                        <tr>
                                            <th class="text-uppercase text-sm ps-2">CEDULA</th>
                                            <th class="text-uppercase text-sm ps-2">TELEFONO</th>
                                            <th class="text-uppercase text-sm ps-2">DESTINO</th>
                                            <th class="text-uppercase text-sm ps-2">IMPORTE</th>
                                            <th class="text-uppercase text-sm ps-2">ESTADO</th>
                                            <th class="text-uppercase text-sm ps-2">ORIGEN</th>
                                            <th class="text-uppercase text-sm ps-2">MOTIVO</th>
                                            <th class="text-uppercase text-sm ps-2">FECHA</th>
                                            <th class="text-uppercase text-sm ps-2">DETALLES</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        @if($total<=0)
                                        <tr>
                                            <td colspan="9">
                                                <h6 class="text-sm mb-0">No hay transacciones en la fecha seleccionada
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        @foreach($transaccions as $row)
                                        <tr style="{{$row->estado == 'Anulada' ? 'background-color: #d97171 !important':''}}">
                                            <td class="text-sm mb-0">{{$row->cedula}}</td>
                                            <td class="text-sm mb-0">{{$row->telefono}}</td>
                                            <td class="text-sm mb-0">{{$row->codigo_transf}}</td>
                                            <td class="text-sm mb-0">{{number_format($row->importe,2)}}</td>
                                            <td class="text-sm mb-0">{{$row->estado}}</td>
                                            <td class="text-sm mb-0">{{$row->origen_nombre}}</td>
                                            <td class="text-sm mb-0">{{$row->motivo_nombre}}</td>
                                            <td class="text-sm mb-0">{{$row->created_at}}</td>
                                            <td class="text-sm mb-0">
                                                <button wire:click.prevent="viewDetails({{$row->id}})" class="btn btn-primary">
                                                    <i class="fas fa-list"></i>
                                                </button>
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

    @include('livewire.arqueos_tigo.modalDetails')

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', Msg => {
            $('#modal-details').modal('show')
        })
    })
</script>