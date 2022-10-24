<div class="">

    <div class="row">
      <div class="col-12 text-center">
        <p class="h1"><b>{{ $componentName }} | {{ $pageTitle }}</b></p>
      </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-12 col-md-4">
            @include('common.searchbox')
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-center">
            
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <button wire:click="Agregar()" type="button" class="boton-azul-g">Nuevo Rol</button>
        </div>

    </div>

    <br>

    <div class="row">
        <div class="table-5">
            <table>
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>DESCRIPCION</th>
                        <th>FECHA CREACION</th>
                        <th>FECHA ACTUALIZACION</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $rol)
                        <tr>
                            <td class="text-center">
                                {{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $rol->name }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($rol->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($rol->updated_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" wire:click="Edit({{ $rol->id }})"
                                    class="boton-azul" title="Editar registro">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)"
                                    onclick="Confirm('{{ $rol->id }}','{{ $rol->name }}','{{ $rol->usuarios }}')"
                                    class="boton-rojo" title="Eliminar registro">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
    @include('livewire.roles.form')


  </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-update', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('role-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-exists', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('modal-hide', Msg => {
            $('#theModal').modal('hide')
        })


    });

    function Confirm(id, name, usuarios) {
        if (usuarios > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar el role "' + name + '" porque hay ' +
                    usuarios + ' usuarios con ese role.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el role ' + '"' + name + '"',
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
