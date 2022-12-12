<div wire:ignore.self class="modal fade" id="lotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Lotes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="d-lg-flex">
                    <div>
                        <h5>{{$nombre_prodlote}}</h5>
                    </div>

                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            @if ($loteproducto)
                            <select wire:model='estados' class="form-control mt--2">
                                <option value="null" disabled>Estado</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                </div>
                

                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 30px;">#</th>
                                            <th style="width: 200px;">Fecha Creacion</th>
                                            <th style="width: 200px;">Existencia</th>
                                            <th style="width: 200px;">Estado</th>
                                            <th style="width: 200px;">Costo Lote</th>
                                            <th style="width: 300px;">p/v Lote</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loteproducto as $data)
                                        <tr class="text-center">
                                            {{-- {{$data}} --}}

                                            <td>
                                                <h6 class="text-center">{{ $loop->iteration}}</h6>
                                            </td>
                                            <td>
                                                <center> {{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}
                                                    <br>
                                                    {{\Carbon\Carbon::parse($data->created_at)->format('h:i:s a')}}
                                                </center>
                                            </td>
                                            <td>
                                                <h6>{{$data->existencia}}</h6>
                                            </td>

                                            <td>
                                                <h6>{{$data->status}}</h6>
                                            </td>

                                            <td>
                                                <h6>{{$data->costo}}</h6>
                                            </td>
                                            <td>
                                                <h6>{{$data->pv_lote}}</h6>
                                            </td>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>