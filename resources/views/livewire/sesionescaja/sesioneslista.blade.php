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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ventas</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Reporte Sesion Caja</h6>
    </nav>
@endsection


@section('Reportescollapse')
    nav-link
@endsection


@section('Reportesarrow')
    true
@endsection


@section('sesionesnav')
    "nav-link active"
@endsection


@section('Reportesshow')
    "collapse show"
@endsection

@section('sesionesli')
    "nav-item active"
@endsection





@section('css')
    <style>
        .tablareporte {
            width: 100%;
        }

        .tablareporte .ie {
            width: 150px;
            text-align: right;
        }

        .tablareporte .fecha {
            width: 120px;
        }

        .tablareporte .no {
            width: 50px;
        }






        /* EStilos para los totales flotantes */

        .flotante {
            /* width: 100%; */
            z-index: 99;
            position: fixed;
            top: 350px;
            right: 50px;
        }
    </style>
@endsection

<div>
    <div class="d-lg-flex" style="margin-bottom: 2.3rem">
        <h5 class="text-white" style="font-size: 16px">Sesiones Cajas </h5>

    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-12 col-sm-6 col-md-2">

                    @can('Reporte_Movimientos_General')
                        <div class="form-group">
                            <b class="">Sucursal</b>
                            <select wire:model="sucursal" class="form-select">
                                @foreach ($sucursales as $item)
                                    <option wire:key="item-{{ $item->id }}" value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                                <option value="TODAS">TODAS</option>
                            </select>
                        </div>
                    @endcan
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="form-group">
                        <b class="">Caja</b>
                        <select wire:model="caja" class="form-select">
                            @foreach ($cajas as $item)
                                <option wire:key="item-{{ $item->id }}" value="{{ $item->id }}">
                                    {{ $item->nombre }}
                                </option>
                            @endforeach
                            <option value="TODAS">TODAS</option>

                        </select>

                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="form-group">

                        <b class="">Fecha inicial</b>

                        <input type="date" wire:model="fromDate" class="form-control">
                        @error('fromDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="form-group">
                        <b class="">Fecha Final</b>
                        <input type="date" wire:model="toDate" class="form-control">
                        @error('toDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

            </div>

        </div>
    </div>


    <br>

    <div class="card mb-4">
        
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-sm text-center">Nº</th>
                            <th class="text-uppercase text-sm">Usuario</th>
                            <th class="text-uppercase text-sm ps-2">Fecha Apertura</th>
                            <th class="text-uppercase text-sm ps-2">Fecha Cierre</th>
                            <th class="text-uppercase text-sm ps-2">Estado Caja</th>
                            <th class="text-center text-uppercase text-sm">Detalle</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aperturas_cierres as $item)
                            
                        <tr>


                            <td class="text-sm mb-0 text-center">
                                {{$loop->iteration+1 }}
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                {{$item->apertura}}
                            </td>

                            <td>
                                {{ $item->status== 'ACTIVO' ?'--':$item->cierre}}
                            </td>
                            <td>
                                @if ($item->status =='ACTIVO')
                                <span class="badge badge-success"> ABIERTO</span>
                                    
                                @else
                                <span class="badge badge-secondary"> CERRADO</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('sesiones', $item->id) }}" class="mx-3">
                                    <i class="fas fa-list text-info"></i>

                                </a>
                                <a href="javascript:void(0)" wire:click="verSesion()" class="mx-3">
                                    <i class="fas fa-plus text-danger"></i>

                                </a>
                            </td>

                        </tr>
                        @endforeach
                  

                    </tbody>
                </table>
            </div>
        </div>

    </div>








</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modalR', Msg => {
            $('#modal-detailsr').modal('show')
        })
        window.livewire.on('show-modalSesion', Msg => {
            $('#modal-sesion').modal('show')
        })
        window.livewire.on('hide-modalR', Msg => {
            $('#modal-detailsr').modal('hide')
            noty(Msg)
        })
        window.livewire.on('tigo-delete', Msg => {
            noty(Msg)
        })

        window.livewire.on('show-modaltotales', Msg => {
            $('#modaltotales').modal('show')
        })

        //Llamando a una nueva pestaña donde estará el pdf modal
        window.livewire.on('opentap', Msg => {
            var win = window.open('report/pdfmovdiaresumen');
            // Cambiar el foco al nuevo tab (punto opcional)
            //win.focus();

        });
    });
</script>
