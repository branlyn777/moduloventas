<div wire:ignore.self class="modal fade" id="modalimport" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-white">
                    <b>Importar Productos</b>
                </h6>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <p>
                <h3 class="badge bg-gradient-primary">1</h5> Descargue la plantilla de ejemplo para importar sus
                productos de un archivo excel.
                </p>

                <div class="card card-sm" style="background-color: bisque">
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

                <p>
                <h3 class="badge bg-gradient-primary">2</h3> Elija su archivo excel que contiene sus productos de
                acuerdo a la plantilla, asegurese que solo una hoja contenga todos sus productos, si tiene otra hoja con
                informacion puede causar errores.
                </p>



                <div class="form-group">
                    @if ($failures)
                    <div class="alert alert-danger" role="alert">
                        @foreach ($failures as $failure)
                        @foreach ($failure->errors() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        @endforeach
                    </div>
                    @endif

                    <form wire:submit.prevent="import('{{$archivo}}')" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{$archivo}}
                        <input type="file" name="import_file" wire:model="archivo" />
                        <button class="btn btn-primary mr-1" type="submit">SUBIR</button>
                    </form>
                </div>



            </div>
            <div class="modal-footer justify-content-center">


         
                        <div class="col-md-3">

                        <button wire:click.prevent="resetUI()" class="btn btn-secondary close-btn"
                            data-bs-dismiss="modal">Cancelar</button>
                        </div>
                




            </div>
        </div>
    </div>
</div>