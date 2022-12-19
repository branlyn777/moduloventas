<div wire:ignore.self id="detailtranference" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title fs-5 text-white text-sm" id="exampleModalCenterTitle">Detalle de transferencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($detalle != null)

                    <div class="table-responsive">
                        <table class="table mb-4" >
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Descripcion</th>
                                    <th class="text-center">Cantidad</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalle as $datas)
                                    <tr>
                                        <td>
                                            <h6 class="text-center">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left">{{ $datas->producto->nombre }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center">{{ $datas->cantidad }}</h6>
                                        </td>



                                    </tr>
                                @endforeach


                @endif

                </tbody>

                </table>

            </div>
        </div>
        <br>
    </div>
</div>
</div>
