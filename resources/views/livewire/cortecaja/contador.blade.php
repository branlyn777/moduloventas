<div wire:ignore.self class="modal fade" id="contador_monedas" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Contador de billetes y monedas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row m-1">
                    <div class="col-lg-6">
                        <h5 class="text-center">Monedas</h5>

                        <div>
                            <table>
                                <tbody>
                                    <tr>

                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" wire:model='diezcent'
                                                aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1"
                                                style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                                <b>0.10</b> </span>
                                        </div>

                                    </tr>
                                    <tr>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" wire:model='veintecent'
                                                aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1"
                                                style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                                <b>0.20</b> </span>
                                        </div>
                                    </tr>
                                    <tr>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" wire:model='cinccent'
                                                aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1"
                                                style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                                <b>0.50</b> </span>
                                        </div>
                                    </tr>
                                    <tr>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" wire:model='peso'
                                                aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1"
                                                style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                                <b>1.00</b> </span>
                                        </div>
                                    </tr>
                                    <tr>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" wire:model='peso2'
                                                aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1"
                                                style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                                <b>2.00</b> </span>
                                        </div>
                                    </tr>
                                    <tr>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" wire:model='peso5'
                                                aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1"
                                                style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                                <b>5.00</b> </span>
                                        </div>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>


                    <div class="col-lg-6">
                        <h5 class="text-center">Billetes</h5>

                        <table>
                            <tbody>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='billete10'
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1"
                                            style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                            <b>10.00</b> </span>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='billete20'
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1"
                                            style="background-color: rgba(5, 164, 225);color:rgb(255, 255, 255);">
                                            <b>20.00</b> </span>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='billete50'
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1"
                                            style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                            <b>50.00</b> </span>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='billete100'
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1"
                                            style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                            <b>100.00</b> </span>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='billete200'
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1"
                                            style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)">
                                            <b>200.00</b> </span>
                                    </div>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="row justify-content-center">

                    <h5 style="border-color:black;border-bottom: 1rem"> <b> Total Bs.: {{ $total }}</b></h5>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" wire:click.prevent="resetConteo()"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn bg-gradient-primary"
                    wire:click.prevent="aplicarConteo()">Aplicar</button>
            </div>
        </div>
    </div>
</div>
