<style>
    .vertical-scrollable>.row {
        position: absolute;
        top: 120px;
        bottom: 100px;
        left: 180px;
        width: 50%;
        overflow-y: scroll;
    }

    .col-sm-8 {
        color: white;
        font-size: 24px;
        padding-bottom: 20px;
        padding-top: 18px;
    }

    .col-sm-8:nth-child(2n+1) {
        background: green;
    }

    .col-sm-8:nth-child(2n+2) {
        background: black;
    }

    table.borderless td,
    table.borderless th {
        border: none !important;
    }

    table.round {
        border-radius: 6px;
    }
</style>

<div wire:ignore.self class="modal fade" id="ordenCompra" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">Ordenes de Compra</p>
                </h1>
                <button type="button" class="btn btn-primary m-1" data-bs-dismiss="modal">x</button>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        @if ($orden != null and $orden->isNotEmpty())
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm text-center">Codigo Orden</th>
                                    <th class="text-uppercase text-sm text-center">Acción</th>
                                </thead>
                                <tbody>
                                    @forelse ($orden as $dataorden)
                                        <tr>
                                            <td class="text-center">
                                                <h6>{{ $loop->index + 1 }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $dataorden->id }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <button href="javascript:void(0)" wire:click="recibirOrden('{{ $dataorden->id }}')" class="btn btn-success">
                                                    <i class="fas fa-check"></i> Recibir Orden
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <p></p>
                                    @endforelse
                                </tbody>
                            </table>
                        @else
                            <div class="table-wrapper row align-items-center m-auto"
                                style="background-color: rgba(145, 250, 189, 0.459)">
                                <div class="col-lg-12">
                                    <div class="row justify-content-center">
                                        <label> No tiene Ordenes de Compra Pendientes</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-primary m-1" data-bs-dismiss="modal">Salir</button>
            </div> --}}
        </div>
    </div>
</div>