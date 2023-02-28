<div wire:ignore.self class="modal fade" id="modaldetails" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        Detalles Cotización
                    </p>
                </h1>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <span aria-hidden="true">&times;</span> --}}
                </button>
            </div>
            <div class="modal-body">

               <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>
                                    No
                                </td>
                                <td>
                                    Nombre Producto
                                </td>
                                <td>
                                    Percio
                                </td>
                                <td>
                                    Cantidad
                                </td>
                                <td>
                                    Total
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->cotization_details as $d)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$d->nombreproducto}}
                                </td>
                                <td>
                                    {{$d->price}}
                                </td>
                                <td>
                                    {{$d->quantity}}
                                </td>
                                <td>
                                    {{$d->price * $d->quantity}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               </div>

            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar Ventana</button> --}}
            </div>
            <br>
        </div>
    </div>
</div>
