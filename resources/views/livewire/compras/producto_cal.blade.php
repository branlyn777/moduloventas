<div wire:ignore.self class="modal fade" id="modal_calculadora" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content table-wrapper">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalCenterTitle">Calcular Nuevo Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
               
            </div>
           <div class="row m-2">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12">

                            Tipo Pronostico
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <select wire:model='tipo' class="form-control mt-2">
                                <option value="null" disabled>Elegir Pronostico</option>
                                <option value="xdias">Los ultimos dias</option>
                                <option value="rango_fechas">Rango de fechas personalizado</option>
                                <option value="mismo_periodo">El mismo período el año pasado</option>
                            </select>
                        </div>
                       
                       
                    </div>
                </div>
                <div class="col-lg-6">
                        <div class="row">
                            @if ($tipo =='xdias')
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">

                                        <label for="" class="mb-2">Introducir Dias</label>
                                        <input type="number" wire:model="ult_dias" class="form-control" placeholder="ej: 7"> 
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($tipo =='rango_fechas')
                            <div class="col-lg-12">
                                <div class="row">
    
                                    <div class="col-md-6 text-center">
                                        <b>Fecha Inicio</b>
                                        <div class="form-group">
                                            <input type="date" wire:model="fromDate" class="form-control" >
                                        </div>
                                    </div>
                    
                                    <div class="col-md-6 text-center">
                                        <b>Fecha Fin</b>
                                        <div class="form-group">
                                            <input type="date" wire:model="toDate" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                </div>
           </div>
           <div class="row m-2 ml-4">
            <div class="col-lg-12">
                <div class="row">

                    <label for="">Sugerir para:</label>
                </div>
                <div class="row">
                    <div class="input-group">

                        <input type="number" wire:model="dias" class="col-lg-5" placeholder="ej: 7">
                        <div class="input-group-append">
                            <span class="input-group-text">Dias</span>
                        </div>
                    </div>
                </div>
            </div>
  
                                                    
           </div>
           <div class="row justify-content-center m-auto">
            <h4 class="col-lg-12">Pronostico del proximo pedido</h4>
                <h2>{{$calculado}} Uds.</h2>
                
               

           </div>
           <div class="row justify-content-center m-auto">
                <button  class="boton-azul mb-4" type="button"  wire:click="aplicarPronostico({{ $prod_exp}})">Aplicar Cantidad</button>
           </div>
            
        </div>
    </div>
</div>