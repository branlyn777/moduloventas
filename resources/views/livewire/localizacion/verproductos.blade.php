<div wire:ignore.self class="modal fade" id="verproductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle" style="font-size: 16px">Lista Mobiliario Producto</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if ($listaproductos != null and $listaproductos->count()>0)
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-container">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-center" style="font-size: 10.4px">
                                                <th>ITEM</th>
                                                <th style="text-align: left">NOMBRE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listaproductos as $data)
                                                <tr class="text-center"  style="font-size: 12px">
                                                    <td>
                                                        {{ $loop->index+1 }}
                                                    </td>

                                                    <td style="text-align: left">
                                                        {{ $data->producto->nombre}}
                                                    </td>

                                                    <td>
                                                        <a href="javascript:void(0)" wire:key="{{ $loop->index }}" class="mx-3"
                                                            wire:click="delete('{{ $data->id }}')" title="Delete">
                                                            <i class="fas fa-trash text-danger" style="font-size: 14px"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table><br>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">CERRAR</button>
            </div> --}}
        </div>
    </div>
</div>