<div>


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
            <button wire:click="Agregar()" type="button" class="boton-azul-g">Nuevo Cliente</button>
        </div>

    </div>


    <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>NOMBRE</th>
                    <th>CÉDULA</th>
                    <th>CELULAR</th>
                    <th>EMAIL</th>
                    <th>FECHA NACIM</th>
                    <th>NIT</th>
                    <th>DIRECCIÓN</th>
                    <th>RAZÓN SOCIAL</th>
                    <th>PROCEDENCIA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $c)
                    <tr>
                        <td>
                            <h6>{{ $c->nombre }}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="text-center">{{ $c->cedula }}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="text-center">{{ $c->celular }}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="text-center">{{ $c->email }}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="text-center">
                                {{$c->fecha_nacim }}
                            </h6>
                        </td>
                        <td class="text-center">
                            <h6 class="text-center">{{ $c->nit }}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="text-center">{{ $c->direccion }}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="text-center">{{ $c->razon_social }}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="text-center">{{ $c->procedencia }}</h6>
                        </td>
                        <td class="text-center">
                            <button href="javascript:void(0)" wire:click="Edit({{ $c->id }})"
                                class="boton-celeste" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @include('livewire.cliente.form')
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
    });

    function Confirm(id, name) {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el usuario ' + '"' + name + '"',
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
