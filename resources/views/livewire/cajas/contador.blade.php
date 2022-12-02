<div wire:ignore.self class="modal fade" id="contador_monedas" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalCenterTitle">Contador de Billetes y Monedas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="row m-1">
                <div class="col-lg-6">
                    <h2 class="text-center">Monedas</h2>
                 
                    <div>
                        <table>
                            <tbody>
                                <tr>
                                
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" wire:model='diezcent' aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>0.10</b> </span>
                                          </div>
                                
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='veintecent' aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>0.20</b> </span>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='cinccent' aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>0.50</b> </span>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='peso' aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>1.00</b> </span>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='peso2' aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>2.00</b> </span>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" wire:model='peso5' aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>5.00</b> </span>
                                    </div>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>


                <div class="col-lg-6">
                    <h2 class="text-center" >Billetes</h2>
                    <div>

                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" wire:model='billete10' aria-describedby="basic-addon1">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>10.00</b> </span>
                                  </div>
                            </tr>
                            <tr>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" wire:model='billete20' aria-describedby="basic-addon1">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225);color:rgb(255, 255, 255);"> <b>20.00</b> </span>
                                  </div>
                            </tr>
                            <tr>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" wire:model='billete50' aria-describedby="basic-addon1">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>50.00</b> </span>
                                  </div>
                            </tr>
                            <tr>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" wire:model='billete100' aria-describedby="basic-addon1">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>100.00</b> </span>
                                  </div>
                            </tr>
                            <tr>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" wire:model='billete200' aria-describedby="basic-addon1">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: rgba(5, 164, 225); color:rgb(255, 255, 255)"> <b>200.00</b> </span>
                                  </div>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
            <div class="row justify-content-center">
              
                    <h1 style="border-color:black;border-bottom: 1rem"> <b> Total Bs.: {{$total}}</b></h1>
            
               </div>
            <div class="row justify-content-end m-1">
              
                <button type="button" wire:click.prevent="resetConteo()" class="boton-verde m-1 p-2"
                data-dismiss="modal">Cancelar</button>

            <button type="button" wire:click.prevent="aplicarConteo()" class="boton-celeste m-1 p-2">Aplicar</button>
            
               </div>

        </div>


 
    </div>
   
</div>