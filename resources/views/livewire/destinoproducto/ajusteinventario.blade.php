<div wire:ignore.self class="modal fade" id="ajustesinv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <label class="text-white text-sm">Operaciones en Inventarios</label>
                {{-- <button type="button" wire:click="resetajuste()" class="btn btn-sm btn-success text-center"> Cerrar </button> --}}
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table align-items-between mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Existencia Actual</th>
                                    <th class="text-center">Mobiliario Asignado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" style="font-size: 0.9rem">
                                    <td>
                                        {{ $productoajuste }}
                                    </td>
                                    <td>
                                        {{ $productstock }}
                                    </td>
                                    <td>
                                        @if ($mop_prod)
                                            @foreach ($mop_prod as $item)
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <span class="text-center pt-2">{{ $item->locations->tipo }}
                                                        {{ $item->locations->codigo }}</span>
                                                    <a href="javascript:void(0)" wire:click="eliminarmob({{ $item->id }} )"
                                                        class="mx-3 pt-2">
                                                        <i class="fas fa-trash text-danger" style="font-size: 14px"></i>
                                                    </a>
                                                </div>
                                                
                                            @endforeach
                                        @else
                                            <label>Sin mobiliarios</label>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-12 col-md-10 ps-9">
                    <div class="form-group text-center">
                        <label> Mobiliarios:</label>
                        <select class="form-select" wire:model='mobiliario' id="inputGroupSelect04"
                            aria-label="Example select with button addon">
                            @if ($mobs)
                                <option value=null disabled selected>Elegir Mobiliario</option>
                                @foreach ($mobs as $data)
                                    <option value="{{ $data->id }}">{{ $data->tipo }}-{{ $data->codigo }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-10 col-md-10 ps-9">
                    <div class="form-group text-center">
                        <button class="btn btn-primary btn-sm" wire:click='asignmob()' type="button">Asignar
                            Mobiliario</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
