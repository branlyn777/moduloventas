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
            <a href="users" type="button" class="boton-atajo-g">
                Ir a Usuarios
                <i>
                    <?xml version="1.0" encoding="UTF-8"?><svg id="Capa_2" xmlns="http://www.w3.org/2000/svg"  style="width: 20px; height: 20px;"
                     viewBox="0 0 391.42 325.75"><defs><style>.cls-2{fill:rgb(255, 255, 255);}</style></defs><g id="Capa_1-2"><path 
                        class="cls-2" d="M0,149.17c1.18-1.12,1.07-2.78,1.71-4.13,3.5-7.39,9.28-11.63,17.41-12.55,1.89-.21,3.82-.14,5.73-.14,84.22,0,168.43,0,252.65,0h4.78c-.29-1.76-1.6-2.46-2.51-3.37-25.9-25.99-51.84-51.95-77.74-77.94-8.17-8.2-10.28-18.7-4.5-27.38,5.37-8.06,12.36-14.99,20.4-20.41,7.62-5.14,17.45-3.9,24.51,2.03,.97,.82,1.91,1.69,2.81,2.59,46.13,46.12,92.26,92.24,138.38,138.38,8.4,8.4,10.08,18.57,4.69,27.74-1.24,2.11-2.9,3.87-4.61,5.58-46.13,46.13-92.25,92.26-138.38,138.37-10.43,10.43-22.86,10.44-33.3,.1-3.35-3.32-6.69-6.64-10.01-9.99-10.12-10.21-10.19-22.52-.03-32.67,26.14-26.11,52.33-52.18,78.49-78.26,.96-.96,1.87-1.97,3.39-3.58H27.58c-16.94,0-21.31-2.91-27.58-18.36v-25.99Z"/></g></svg>
                </i>
            </a>
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