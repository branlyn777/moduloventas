<div wire:ignore.self class="modal fade" id="fastservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Servicio Rápido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="">Tipo de Equipo</label>
                            <div class="input-group">
                                <select class="form-select" wire:model="fs_kind_of_team">
                                    <option value="Elegir">Elegir</option>
                                    @foreach ($cate as $cat)
                                        @if ($cat->estado == 'ACTIVO')
                                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('fs_kind_of_team')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="">Marca/Modelo</label>
                            <datalist id="fs_marks">
                                @foreach ($fs_marks as $cat)
                                    @if ($cat->status == 'ACTIVE')
                                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                    @endif
                                @endforeach
                            </datalist>
                            <input list="fs_marks" wire:model.lazy="fs_mark" name="colores" type="text" class="form-control">
                            @error('fs_mark')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="">Estado del Equipo</label>
                            <div class="input-group">
                                <input type="text" wire:model.lazy="fs_team_status" class="form-control" placeholder="Ej: Huawei Y9 Prime Color Negro....">
                            </div>
                            @error('fs_team_status')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="">Solución</label>
                            <div class="input-group">
                                <input type="text" wire:model.lazy="fs_solution" class="form-control" placeholder="Ej: No tiene Señal...">
                            </div>
                        </div>
                        @error('fs_solution')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="">Total</label>
                            <div class="input-group">
                                <input type="number" wire:model.lazy="fs_import" class="form-control">
                            </div>
                        </div>
                        @error('fs_import')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="">Responsable Técnico</label>
                            <select class="form-select" wire:model="fs_technical_support">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn bg-gradient-primary" wire:click.prevent="SaveFastService()">Guardar Servicio</button>
            </div>
        </div>
    </div>
</div>
