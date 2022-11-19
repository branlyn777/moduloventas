<div>



    <div class="row">
        <div class="col-12 text-center">
          <p class="h1"><b>{{ $componentName }} | {{ $pageTitle }}</b></p>
        </div>
      </div>
  
      <div class="row">
  
          {{-- <div class="col-12 col-sm-12 col-md-4">
              @include('common.searchbox')
          </div> --}}
  
          <div class="col-12 col-sm-12 col-md-4 text-center">
              
          </div>
  
          <div class="col-12 col-sm-12 col-md-4 text-right">
            <a href="sucursales" type="button" class="boton-atajo-g">
                Ir a Sucursales
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
                    <th>NOMBRE DE LA EMPRESA</th>
                    <th>NOMBRE CORTO</th>
                    <th>DIRECCIÓN</th>
                    <th>TELÉFONO</th>
                    <th>NÚMERO NIT</th>
                    <th>LOGO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            {{ $item->shortname }}
                        </td>
                        <td>
                            {{ $item->adress }}
                        </td>
                        <td>
                            {{ $item->phone }}
                        </td>
                        <td>
                            {{ $item->nit_id }}
                        </td>
                        <td class="text-center">
                            <span>
                                <img src="{{ asset('storage/iconos/' . $item->image) }}" alt="imagen" width="70px" height="70px">
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                class="boton-celeste" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            {{-- <a href="javascript:void(0)" onclick="Confirm('{{ $item->id }}','{{ $item->name }}',
                            '{{ $item->relacionados->count() }}')" class="boton-rojo" title="Borrar">
                                <i class="fas fa-trash"></i>
                            </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @include('livewire.company.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('item-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('item-deleted', msg => {
            noty(msg)
        });
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
    });

    function Confirm(id, name, cantRelacionados) {
        if (cantRelacionados > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la empresa "' + name + '" porque tiene ' +
                    cantRelacionados + ' sucursales.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la empresa ' + '"' + name + '"?.',
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
