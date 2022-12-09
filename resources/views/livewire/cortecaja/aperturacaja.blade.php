<div wire:ignore.self class="modal fade" id="aperturacaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Apertura de Caja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($idcaja!==null)
                <div class="row justify-content-center">
                    <div class="mb-2">
                        <div class="row m-2">
                            <div class="mb-2">
                                <table>
                                    <tbody>
                                       
                                        <tr>
                                            <td class="text-right">
                                                <h5> Esperado en Efectivo: </h5>
                                            </td>
                                            <td class="text-right">
                                                <h5> Bs. {{$saldoAcumulado}}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                <h5>Efectivo Actual:</h5>
                                            </td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-outline-primary mb-0" type="button"
                                                        id="button-addon1" data-bs-toggle="modal"
                                                        data-bs-target="#contador_monedas"><i class="fas fa-calculator"></i></button>
                                                    <input type="text" class="form-control" wire:model='efectivo_actual' placeholder="">
                                                </div>

                                            </td>


                                        </tr>

                                        <br>
                                

                                     
                                      

                                    </tbody>
                                </table>
                            </div>
                        </div>
                      

                    </div>

                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-warning" wire:click='CorteCaja({{$idcaja}})'>Iniciar Sesion</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>