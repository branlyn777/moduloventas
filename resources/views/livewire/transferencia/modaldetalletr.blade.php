<div wire:ignore.self id="detailtranference" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title fs-5 text-white text-sm" id="exampleModalCenterTitle">Detalle de transferencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="min-height: 300px; padding-top: 10px;">
                @if ($detalle != null)

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Descripcion</th>
                                    <th class="text-center">Cant.</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalle as $datas)
                                   <u> <tr>
                                        <td>
                                            <h6 class="text-center text-sm">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left text-sm">{{ $datas->producto->nombre }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center text-sm">{{ $datas->cantidad }}</h6>
                                        </td>



                                    </tr>
                                </u>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="text-center text-sm" > Total Un.</h6>
                                    </td>
                                    <td colspan="1">
                                        <h6 class="text-center text-sm" >{{$detalle->sum('cantidad')}}</h6>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                @endif

            </div>
            <br>
        </div>
    </div>
</div>