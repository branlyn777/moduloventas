
@section('migaspan')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
            <a class="text-white" href="javascript:;">
                <i class="ni ni-box-2"></i>
            </a>
        </li>
        <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                href="{{ url('') }}">Inicio</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Sucursales</h6>
</nav>
@endsection


@section('empresacollapse')
nav-link
@endsection


@section('empresaarrow')
true
@endsection


@section('companiesnav')
"nav-link active"
@endsection


@section('empresashow')
"collapse show"
@endsection

@section('companiesli')
"nav-item active"
@endsection



<div class="row mt-4">

    <div class="col-12 col-lg-5">

        <div class="card mb-3 mt-lg-0">
            <div class="card-body pb-0 align-middle text-center">
                <h5 class="mb-4 align-middle text-center">Logo Principal</h5>
                

                <div style="margin-bottom: 15px;">
                    <img wire:model="imagen" class="w-80 border-radius-lg mx-auto"
                        src="{{ asset('storage/iconos/' . $imagen) }}" alt="chair">
                      



                        <button wire:click="$emit('show-modallogoprincipal')" class="btn btn-primary">
                            Cambiar Imagen
                        </button>
                </div>

            </div>
        </div>




        <div class="card mt-4 mb-3">
            <div class="card-body pb-0 align-middle text-center">
                <h5 class="mb-4 align-middle text-center">Logo Horizontal</h5>
                <div class="row align-items-center mb-3">
                    


                    <div>
                        <img wire:model="imagen_horizontal" class="w-80 border-radius-lg mx-auto"
                            src="{{ asset('storage/iconos/' . $imagen_horizontal) }}" alt="chair">


                            <button wire:click="$emit('show-modallogohorizontal')" class="btn btn-primary">
                                Cambiar Imagen
                            </button>
                    </div>


                </div>
            </div>
        </div>




    </div>















    <div class="col-12 col-lg-7">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4 align-middle text-center">Datos de tu Empresa</h5>
                <div class="">
                    <div class="col-lg-10 mx-auto">

                        <h6 class="mb-0 mt-3">Nombre de la Empresa</h6>
                        <input wire:model="nombre_empresa" class="form-control" type="text"
                            value="{{ $nombre_empresa }}">
                        @error('nombre_empresa')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror





                        <h6 class="mb-0 mt-3">Dirección</h6>
                        <input wire:model="direccion" class="form-control" type="text" value="{{ $direccion }}">
                        @error('direccion')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror


                        <h6 class="mb-0 mt-3">Teléfono</h6>
                        <input wire:model="telefono" class="form-control" type="text" value="{{ $telefono }}">
                        @error('telefono')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror




                        <h6 class="mb-0 mt-3">Nit</h6>
                        <input wire:model="nit_id" class="form-control" type="text" value="{{ $nit_id }}">
                        @error('nit_id')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror




                        <h6 class="mb-0 mt-3">Fecha Última Actualización</h6>
                        <div class="">
                            {{ \Carbon\Carbon::parse($updated_at)->format('d/m/Y H:i') }}
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-12 align-middle text-center">
                                <button onclick="Confirm()" class="btn btn-primary">
                                    Actualizar Datos
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>



















    @include('livewire.company.modal1')
    @include('livewire.company.modal2')
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        window.livewire.on('show-modallogoprincipal', msg => {
            $('#modallogoprincipal').modal('show')
        });
        window.livewire.on('show-modallogohorizontal', msg => {
            $('#modallogohorizontal').modal('show')
        });
    });

    function Confirm() {
        swal({
            title: '¿Actualizar Información?',
            text: "Los datos de la empresa se actualizarán con la información proporcionada",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Actualizar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('update_company')
            }
        })
    }
</script>
