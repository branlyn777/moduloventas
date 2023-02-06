<style>
    .prueba {

        overflow: scroll;


        width: auto;
        height: 150px;
    }
</style>

<div wire:ignore.self class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-white">
                    <b>Importar Productos</b>
                </h6>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="mb-1">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <h1 class="badge bg-gradient-primary" style="font-size: 1rem">1</h1>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-sm">Descargue la plantilla de ejemplo para importar sus
                                    productos de un archivo excel.</p>
                            </div>
                        </div>

                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <button class="btn btn-sm btn-info" wire:click="downloadex()">
                                            Descargar Plantilla
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="d-flex mt-3">
                            <div class="flex-shrink-0">
                                <h1 class="badge bg-gradient-primary" style="font-size: 1rem">2</h1>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-sm">Elija su archivo excel que contiene sus productos de
                                    acuerdo a la plantilla, asegurese que solo una hoja contenga todos sus productos, si
                                    tiene otra hoja
                                    con informacion puede causar errores.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">

                    <form wire:submit.prevent="import('{{ $archivo }}')" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <center>
                            <div wire:loading wire:target="archivo">
                                <div class="d-flex align-items-center">
                                    <strong>Cargando Archivo, Espere por
                                        favor...</strong>
                                    <div class="spinner-border ms-auto"></div>
                                </div>
                            </div>
                        </center>

                        <label for="">Archivo Seleccionado</label>
                        <input type="file" class="form-control mb-4" name="import_file" wire:model.lazy="archivo"
                            accept=".xls,.xlsx" wire:click='resetes()' />



                        <div style="text-align: right">
                            @if ($archivo != null)
                                <button class="btn btn-sm btn-success mt-1" type="submit">Subir Archivo</button>
                            @else
                                <button class="btn btn-sm btn-success mt-1" disabled type="submit">Subir
                                    Archivo</button>
                            @endif
                        </div>


                    </form>
                    @if ($failures)
                        <div class="card p-2 m-1" style="background-color: rgb(224, 224, 224);">
                            <div class="prueba">



                                @foreach ($failures as $failure)
                                    @foreach ($failure->errors() as $error)
                                        <li>{{ $error }},numero de fila {{ $failure->row() }}.</li>
                                    @endforeach
                                @endforeach


                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>
</div>
