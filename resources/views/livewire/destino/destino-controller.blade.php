

<div>
    <div class="row">
        <div class="col-12 text-center mb-5">
          <p class="h2"><b>ESTANCIA</b></p>
        </div>
    </div>
    <div class="container"> 
        <div class="row">

            <div class="col-12 col-sm-12 col-md-3">
                @include('common.searchbox')
            </div>
    
            <div class="col-12 col-sm-12 col-md-3 text-center">
                <select wire:model='estados' class="form-control">
                    <option value="null" disabled>Estado</option>
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                    <option value="TODOS">TODOS</option>
                  </select>
            </div>
    
            <div class="col-12 col-sm-12 col-md-3 text-center">
                
            </div>
    
            <div class="col-12 col-sm-12 col-md-3 text-center">
                <button class="boton-azul-g" data-toggle="modal" data-target="#theModal" wire:click="resetUI()"> <i class="fas fa-plus-circle"></i> Agregar Estancia</button>
            </div>
        </div>
 

    </div>


                <div class="table-6">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">ITEM</th>
                                <th class="text-center">NOMBRE</th>                                
                                <th class="text-center">OBSERVACION</th>
                                <th class="text-center">SUCURSAL</th>
                                <th class="text-center">ESTADO</th>
                                <th class="text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>
                                        <center><h6>{{$loop->index+1}}</h6></center>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $data->nombre }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $data->observacion }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $data->name }}</h6>
                                    </td>
                                    @if ($data->status== 'ACTIVO')
                                    
                                    <td class="text-center" >
                                        <span class="badge badge-success mb-0">{{$data->status}}</span>
                                    </td>
                                    @else
                                    <td class="text-center" ><span class="badge badge-danger mb-0">{{$data->status}}</span></td>
                                        
                                    @endif
                                    
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="Edit({{ $data->id }})"
                                            class="btn btn-dark p-1" title="Editar Estancia">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}')" 
                                            class="btn btn-danger p-1" title="Eliminar Estancia">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $datas->links() }}
                </div>
            
                @include('livewire.destino.form')
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('unidad-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('unidad-updated', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('unidad-deleted', msg => {
            ///
        });
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });        
        $('theModal').on('hidden.bs.modal',function(e) {
            $('.er').css('display','none')
        })

    });

    function Confirm(id,nombre) {
     
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar la unidad ' + '"' + nombre + '"',
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