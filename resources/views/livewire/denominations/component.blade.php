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
            <a href="javascript:void(0)" class="boton-azul-g" data-toggle="modal" data-target="#theModal">Agregar</a>
        </div>

    </div>

    <br>



    <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>TIPO</th>
                    <th>VALOR</th>
                    <th>IMAGEN</th>                                
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $coin)
                    <tr>
                        <td>
                            {{ $coin->type }}
                        </td>
                        <td>
                            {{ number_format($coin->value,2) }}
                        </td>                            
                        <td class="text-center">
                            <span>
                                <img src="{{ asset('storage/monedas/' . $coin->imagen) }}"
                                    alt="imagen de ejemplo" height="70" width="80" class="rounded">
                            </span>
                        </td>
                        <td class="text-center">
                            <button wire:click="Edit({{ $coin->id }})"
                                class="boton-celeste" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="Confirm('{{ $coin->id }}','{{ $coin->type }}')" 
                                class="boton-rojo" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @include('livewire.denominations.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('coin-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('coin-updated', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('coin-deleted', msg => {
            ///
        });
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });        
        $('theModal').on('hidden.bs.modal',function(e) {
            $('.er').css('display','none')
        })

    });

    function Confirm(id, type, products) {
        if (products > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la moneda, ' + type + ' porque tiene ' 
                + products + ' ventas relacionadas'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar la moneda ' + '"' + type + '"',
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