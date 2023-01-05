<div wire:ignore.self id="modal-details" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="text-white text-sm" id="exampleModalLabel">
                    Historial Sucursales
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-7 col-md-7">
                        <div class="form-group">
                            <h6>Cambiar de sucursal</h6>
                            <select wire:model='sucursalUsuario' class="form-select">
                                <option value="Elegir" disabled>Elegir</option>
                                @foreach ($sucursales as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                            @error('sucursalUsuario')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                  

                </div>

              

                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr class="text-center">
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                                <th>SUCURSAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $d)
                                <tr
                                    style="{{ $d->fecha_fin == null ? 'background-color: lightgreen !important' : '  ' }}">
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($d->fecha_fin != null)
                                            {{ \Carbon\Carbon::parse($d->fecha_fin)->format('d/m/Y H:i:s') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $d->name }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    
                    </table>
                </div>



               
                    <div class="modal-footer">
                     
                                {{--  
                                            <button type="button" class="btn btn-primary" wire:click.prevent="finalizar()">BLOQUEAR AL USUARIO</button>

                                        
                                    
                                        @if ($usuarioACTIVO == 'NO')
                                        
                                                <button type="button" class="btn btn-primary" wire:click.prevent="Activar()">PONER
                                                    ACTIVO AL USUARIO</button>

                                                    
                                        
                                        @endif --}}
                  
                    <button type="button" class="btn btn-info mt-6 p-2" wire:click.prevent="Cambiar()"> <h7>ASIGNAR NUEVA SUCURSAL</h7> </button>
               
                    
                    
                    </div>
              

            </div>
        </div>
    </div>
</div>
