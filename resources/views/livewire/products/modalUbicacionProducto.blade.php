<div wire:ignore.self class="modal fade" id="ubicacionProductos" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Ubicacion Producto</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <h6>{{ $prod_sel }}</h6>
                    <div class="col p-4">
                        @if ($pr->isNotEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sucursal</th>
                                        <th scope="col">Destino</th>
                                        <th scope="col">Mobiliario</th>
                                        <th scope="col">Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pr as $prods)
                                        <tr>
                                            <th scope="row">{{$prods->destinos->sucursals->name}}</th>
                                            <td>{{$prods->destinos->nombre}}</td>
                                            <td>
                                                @forelse ($prods->mob as $ismob)
                                                {{$ismob->codigo}}
                                                    
                                                @empty
                                                    Sin mobiliario
                                                @endforelse
                                            </td>
                                            <td>{{$prods->stock}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
