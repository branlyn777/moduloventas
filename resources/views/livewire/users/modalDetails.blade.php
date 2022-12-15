<div wire:ignore.self id="modal-details" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    Historial Sucursales
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <h6>Cambiar de sucursal</h6>
                            <select wire:model='sucursalUsuario' class="form-control">
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

                    <div class="col-sm-12 col-md-3">
                        <button type="button" class="btn btn-primary" wire:click.prevent="Cambiar()">ASIGNAR NUEVA
                            SUCURSAL</button>
                    </div>

                </div>

                <div class="table-1">
                    <table>
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
                        <tfoot>
                            <td class="col-sm-12 col-md-8" colspan="3">
                                <br>
                                <button type="button" class="btn btn-primary" wire:click.prevent="finalizar()">DAR
                                    DE BAJA AL USUARIO</button>
                                <br>
                                <br>
                            </td>
                            @if ($usuarioACTIVO == 'NO')
                                <td class="text-left" colspan="2">
                                    <button type="button" class="btn btn-primary" wire:click.prevent="Activar()">PONER
                                        ACTIVO AL USUARIO</button>
                                </td>
                            @endif
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
