<div>


    <div class="row">
        <div class="col-12 text-center">
            <p class="h1"><b>{{ $componentName }} | {{ $pageTitle }}</b></p>
        </div>
    </div>
  
    <div class="row">

        <div class="col-12 col-sm-6 col-md-4">
            @include('common.searchbox')
        </div>

        <div class="col-12 col-sm-6 col-md-4 text-center">
            
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <button wire:click="Agregar()" type="button" class="boton-azul-g">Nuevo Usuario</button>
        </div>
  
      </div>


      <br>


      <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>USUARIO</th>
                    <th>TELÉFONO</th>
                    <th>EMAIL</th>
                    <th>PERFIL</th>
                    <th>STATUS</th>
                    <th>SUCURSAL</th>
                    <th>IMAGEN</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $r)
                    <tr>
                        <td>
                            {{ $r->name }}
                        </td>
                        <td class="text-center">
                            {{ $r->phone }}
                        </td>
                        <td class="text-center">
                            {{ $r->email }}
                        </td>
                        <td class="text-center">
                            {{ $r->profile }}
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $r->status == 'ACTIVE' ? 'badge-success' : 'badge-danger' }} text-uppercase">
                                {{ $r->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            @foreach ($r->sucursalusers as $su)
                                @if ($su->estado == 'ACTIVO')
                                    {{ $su->sucursal->name }}
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            <span>
                                <img src="{{ asset('storage/usuarios/' . $r->imagen) }}" alt="imagen"
                                    class=" rounded" width="70px" height="70px">
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="Edit({{ $r->id }})"
                                class="boton-azul" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="javascript:void(0)"
                                onclick="Confirm('{{ $r->id }}','{{ $r->name }}')"
                                class="boton-rojo" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>

                            <button wire:click.prevent="viewDetails('{{ $r->id }}')"
                                class="boton-verde">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>


    @include('livewire.users.form')
    @include('livewire.users.modalDetails')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('sucursal-actualizada', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        });
        window.livewire.on('user-withsales', Msg => {
            noty(Msg)
        })
        window.livewire.on('user-fin', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        })
        window.livewire.on('show-modal2', Msg => {
            $('#modal-details').modal('show')
        })
    });

    function Confirm(id, name, movimientos) {
        if (movimientos > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar al usuario "' + name + '" porque tiene varios movimientos.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar el usuario ?',
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
