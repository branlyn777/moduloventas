
<div wire:ignore.self class="modal fade" id="modalbuscarcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: rgb(252, 130, 42); color: white;">
            <h5 class="modal-title" id="exampleModalLongTitle">Buscar Cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                
                <div class="col-sm-12">
                    
                    <div class="input-group" style="padding-right: 20px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-gp">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" wire:model="buscarcliente" placeholder="Buscar o Crear Cliente..." class="form-control">
                    </div>
                    <br>
                    <div class="table-wrapper">
                        @if(strlen($this->buscarcliente) > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre Cliente</th>
                                    <th class="text-center">Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listaclientes as $lc)
                                <tr>
                                    <td class="text-left">
                                        {{ ucwords(strtolower($lc->nombre)) }}
                                    </td>
                                    <td class="text-center">
                                        <button title="Seleccionar Cliente" wire:click.prevent="seleccionarcliente({{ $lc->id }})" class="btn btn-sm" style="background-color: rgb(10, 137, 235); color:white">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty

                                <tr class="text-center">
                                    <td colspan="2">


                                        <div class="row">

                                            <div class="col-8 col-sm-12">
                                                <button class="btn" wire:click.prevent="crearcliente()" style="background-color: chartreuse;">
                                                    Crear u Usar: {{$this->buscarcliente}}
                                                </button>
                                            </div>


                                            <div class="col-8 col-sm-6">
                                                <label for="validationTooltip01"><b>Cédula</b></label>
                                                <input wire:model.lazy="cliente_ci" class="form-control" type="text" placeholder="Opcional...">
                                            </div>
                                            <div class="col-4 col-sm-6">
                                                <label for="validationTooltipUsername"><b>Celular</b></label>
                                                <input wire:model.lazy="cliente_celular" class="form-control" type="number" placeholder="Opcional...">
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforelse





                            </tbody>
                        </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar Ventana</button>
            </div>
            <br>
        </div>
    </div>
</div>