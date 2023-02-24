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
                                <select wire:model='selected_type' class="form-select">
                                    <option value="todas">Todas las notificaciones</option>
                                    <option value="leidos">Leidos</option>
                                    <option value="no_leidos">Sin Leer</option>

                                </select>

                            </div>

                        </div>
                    </div>
                </div>
            </div>



            @foreach ($data as $item)
                <div class="card my-3 py-2">

                    @if ($item->read_at !=null)
                        
                    <div class="d-flex">
                        <div class="p-2">
                            {{-- <i class="fa-regular fa-square-check" style="font-size: 30px"></i> --}}
                            <i class="fa-solid fa-bullhorn text-secondary" style="font-size: 25px"></i>
                        </div>
                        <div class="p-2">
                            <blockquote class="blockquote mb-0 ps-1" style="border-color: rgb(60, 80, 97)">
                                <h5 style="font-size: 14px">Nivel bajo de stock detectado en tus inventarios
                                    ({{ $item->created_at->diffForHumans() }})
                                </h5>
                                <h5 style="font-size: 10px">{{ $item->data['nombre'] }}</h5>

                            </blockquote>

                        </div>

                        <div class=" ms-auto p-2">

                            <button class="btn btn-secondary btn-sm p-2" type="button"
                                wire:click="mostrarNotificacion('{{ $item->id }}')">
                                Ver Mas
                            </button>

                        </div>
                    </div>
                    @else
                        
                    <div class="d-flex">
                        <div class="p-2">
                            {{-- <i class="fa-regular fa-square-check" style="font-size: 30px"></i> --}}
                            <i class="fa-solid fa-bullhorn text-danger" style="font-size: 25px"></i>
                        </div>
                        <div class="p-2">
                            <blockquote class="blockquote mb-0 ps-1" style="border-color: rgb(247, 127, 127)">
                                <h5 style="font-size: 14px">Nivel bajo de stock detectado en tus inventarios
                                    ({{ $item->created_at->diffForHumans() }})
                                </h5>
                                <h5 style="font-size: 10px">{{ $item->data['nombre'] }}</h5>

                            </blockquote>

                        </div>

                        <div class=" ms-auto p-2">

                            <button class="btn btn-secondary btn-sm p-2" type="button"
                                wire:click="mostrarNotificacion('{{ $item->id }}')">
                                Ver Mas
                            </button>

                        </div>
                    </div>
                    @endif


                </div>
            @endforeach
            <div>
                {{ $data->links() }}
            </div>

        </div>
    </div>
    @include('livewire.notificationinventory.mostrarNotificacion')
</div>

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('verNotificacion', msg => {
                $('#verNoti').modal('show')
            });
        });
    </script>
@endsection
