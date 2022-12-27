<div wire:ignore.self class="modal fade" id="modallogoprincipal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        Cambar Logo Principal
                    </p>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row m-2">
                            <div class="col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="card-body">


                                        <input type="file" wire:model='logoprincipal' accept="image/*">
                                        <i class="fas fa-camera text-white text-center"></i>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    CANCELAR
                </button>
                @if($this->logoprincipal)
                <button type="button" wire:click.prevent="UpdateLogoPrincipal()" class="btn btn-primary">
                    ACTUALIZAR
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
