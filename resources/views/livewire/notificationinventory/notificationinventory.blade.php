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
        <h6 class="font-weight-bolder mb-0 text-white"> Notificaciones </h6>
    </nav>
@endsection


@section('notificationnav')
    "nav-link active"
@endsection

@section('notificationli')
    "nav-item active"
@endsection
<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pt-0 mb-4">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Notificaciones</h5>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-md-6">

                                <h6>Mostrar las notificaciones</h6>
                                <select wire:model='selected_id' class="form-select">
                                    <option value="todas">Todas las notificaciones</option>
                                    <option value="leidos">Leidos</option>
                                    <option value="no_leidos">Sin Leer</option>
                                 
                                </select>

                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <table class="table align-items-between">
                    
                            <thead>
                                <th>
                                    N°
                                </th>
                                <th>
                                    Notificacion
                                </th>
                                <th>
                                    Fecha
                                </th>
                                <th>
                                    Acc.
                                </th>
                            </thead>

                            <tbody>
                                @foreach (auth()->user()->unreadNotifications as $item)
                                    
                                <tr>

                                    <td>
                                        {{$loop->iteration+1}}
                                    </td>
                                    <td>
                                      El producto {{$item->data['nombre']}} esta sin stock, revise sus almacenes para poder abastecerse.
                                    </td>
                                    <td>
                                        {{ $item->created_at->diffForHumans() }}
                                    </td>

                                    <td>
                                        <button class="btn btn-success" type="button">
                                            Marcar como leido
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
