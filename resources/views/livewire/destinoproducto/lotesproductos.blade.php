<div wire:ignore.self class="modal fade" id="lotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <label class="modal-title text-white" style="font-size: 14px">Lotes</label>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                {{-- <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center" 
                    data-bs-dismiss="modal">
                    <i class="fa fas-circle-xmark text-white" aria-hidden="true">x</i>
                </button> --}}
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="d-lg-flex">
                    <div>
                        <label style="font-size: 14px">{{$nombre_prodlote}}</label>
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
                                <table class="table align-items-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">N°</th>
                                            <th >Fecha Creacion</th>
                                            <th >Existencia</th>
                                            <th >Costo Lote</th>
                                            <th >p/v Lote</th>
                                            <th class="text-center">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loteproducto as $data)
                                        <tr style="font-size: 14px">
                                            {{-- {{$data}} --}}

                                            <td class="text-center">
                                                {{ $loop->iteration}}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}
                                                <br>
                                                {{\Carbon\Carbon::parse($data->created_at)->format('h:i:s a')}}
                                            </td>
                                            <td>
                                                {{$data->existencia}}
                                            </td>
                                            <td>
                                                {{$data->costo}}
                                            </td>
                                            <td>
                                                {{$data->pv_lote}}
                                            </td>
                                            <td class="text-center">
                                                {{$data->status}}
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