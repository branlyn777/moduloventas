
<div wire:ignore.self class="modal fade" id="modalbuscarcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="exampleModalLongTitle">
                <p class="text-sm mb-0">
                    Buscar Cliente
                </p>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                
                <div class="col-sm-12">
                    
                    <div class="input-group" style="padding-right: 20px;">
                        <span style="background-color: #5e72e4; color: white" class="input-group-text"><i class="fa fa-search"></i></span>
                        <input type="text" wire:model="buscarcliente" placeholder="Buscar o Crear Cliente..." class="form-control" style="padding-left: 10px;">
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
                                        
                                        <a href="javascript:void(0)" title="Seleccionar Cliente" wire:click.prevent="seleccionarcliente({{ $lc->id }})">
                                            <i class="fas fa-plus text-primary"></i>
                                        </a>

                                    </td>
                                </tr>
                                @empty

                                <tr class="text-center">
                                    <td colspan="2">

                                        <br>
                                        <div class="row">


                                            <div class="col-sm-6">
                                                <label for="validationTooltip01"><b>Cédula</b></label>
                                                <input wire:model.lazy="cliente_ci" class="form-control" type="text" placeholder="Opcional...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="validationTooltipUsername"><b>Celular</b></label>
                                                <input wire:model.lazy="cliente_celular" class="form-control" type="number" placeholder="Opcional...">
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="validationTooltipUsername"><b>Procedencia Cliente</b></label>
                                                <select wire:model="procedencia_cliente_id" class="form-control">
                                                    <option value="Elegir">Elegir</option>
                                                    @foreach($this->procedencias as $p)
                                                    <option value="{{$p->id}}">{{$p->procedencia}}</option>
                                                    @endforeach
                                                </select>
                                                @error('procedencia_cliente_id') <span class="text-danger er">{{ $message }}</span>@enderror
                                            </div>


                                            

                                        </div>

                                        <br>

                                        <div class="col-sm-12">
                                            <button class="btn btn-primary" wire:click.prevent="crearcliente()">
                                                Crear y Usar: {{$this->buscarcliente}}
                                            </button>
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