@section('css')
<style>
    /* Estilos para el Switch Cliente Anónimo y Factura*/
    .switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
    }
    .switch input {display:none;}
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgb(133, 133, 133);
    -webkit-transition: .4s;
    transition: .4s;
    }
    .slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 2px;
    bottom: 1px;
    background-color: rgb(255, 255, 255);
    -webkit-transition: .4s;
    transition: .4s;
    }
    input:checked + .slider {
    background-color: #02b1ce;
    }
    input:focus + .slider {
    box-shadow: 0 0 1px #02b1ce;
    }
    input:checked + .slider:before {
    -webkit-transform: translateX(19px);
    -ms-transform: translateX(19px);
    transform: translateX(19px);
    }
    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }
    .slider.round:before {
    border-radius: 40%;
    }
</style>
@endsection

<div>
    <div class="row">
        <div class="col-12 text-center">
          <p class="h1"><b>{{ $componentName }}</b></p>
        </div>
    </div>
  
    <div class="row">

        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Seleccione Rol</b>
            <select wire:model="role" class="form-control">
                <option value="Elegir" selected>==Seleccione el rol==</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}" selected>{{$role->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Area Permiso</b>
            <select wire:model="permisosseleccionado" class="form-control">
                <option value="Todos"><b>Todos los Permisos</b></option>
                @foreach ($listaareas as $u)
                <option value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b style="color: white;">|</b>
            <br>
            @if($permisosseleccionado != "Todos")
            <button wire:click.prevent="SyncAll2()" type="button" class="boton-azul-g">Sincronizar Todos Area</button>
            @else
            <button wire:click.prevent="SyncAll()" type="button" class="boton-azul-g">Sincronizar Todos</button>
            {{-- <button onclick="Revocar()" type="button" class="boton-rojo-g">Revocar Todos</button> --}}
            @endif
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b style="color: white;">|</b>
            <br>
            @if($permisosseleccionado == "Todos")
            <button onclick="Revocar()" type="button" class="boton-rojo-g">Revocar Todos</button>
            @endif
        </div>


    </div>

    <br>

    <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>#</th>
                    <th>PERMISO</th>
                    <th>ROLES CON EL PERMISO</th>
                    <th>AREA</th>
                    <th>DESCRIPCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permisos as $permiso)
                <tr>
                    <td class="text-center">
                        {{ ($permisos->currentpage()-1) * $permisos->perpage() + $loop->index + 1 }}
                    </td>
                    <td class="text-center">

                        <div style="padding-top: 5px;">
                            <label class="switch">
                                <input type="checkbox"

                                wire:change="SyncPermiso($('#p' + {{ $permiso->id}}).is(':checked'), '{{$permiso->name}}')"

                                id="p{{ $permiso->id }}"

                                value="{{ $permiso->id }}"

                                {{ $permiso->checked == 1 ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        {{ $permiso->name}}
                    </td>
                    <td class="text-center">
                        {{ \App\Models\User::permission($permiso->name)->count() }}
                    </td>
                    <td class="text-center">
                        {{$permiso->area}}
                    </td>
                    <td>
                        {{$permiso->descripcion}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $permisos->links() }}
    </div>

</div>








<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('sync-error', Msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            padding: '2em'
            });
            toast({
                type: 'info',
                title: 'Error al ejecutar acción',
                padding: '2em',
            })
        });
        window.livewire.on('permi', Msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: '¡Cambio Hecho Exitósamente!',
                padding: '2em',
            })
        });
        window.livewire.on('syncall', Msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: '¡Permisos sincronizados exitósamente!',
                padding: '2em',
            })
        });
        window.livewire.on('removeall', Msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: '¡Todos los permisos removidos exitósamente!',
                padding: '2em',
            })
        });
    });
    function Revocar()
    {
        swal({
        title: '¿Revocar todos los Permisos?',
        text: "Esta acción removerá todos los permisos del rol seleccionado",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Revocar Permisos',
        padding: '2em'
        }).then(function(result) {
        if (result.value) {
            window.livewire.emit('revokeall')
            }
        })
    }
</script>