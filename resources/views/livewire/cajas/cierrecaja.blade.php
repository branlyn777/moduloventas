<div class="row justify-content-start">
    <div class="m-2 p-3" style="width: 70rem;">

        <div class="row">
            <div class="col-lg-12">

                <h2 class="text-dark"
                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 1.5rem; font-weight:650">
                    PUNTO DE VENTA / {{$caja->nombre}}</h2>

                <h2 class="text-dark mb-0 pb-0"
                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 1.5rem; font-weight:500">
                    Control de Efectivo</h2>
                {{--
                <hr class="mt-0" style="background-color: rgba(9, 157, 255, 0.534); height: 3px; width:100px;"> --}}
                <br>
            </div>

        </div>

        <div class="row justify-content-start">
            <div class="col-lg-12">

                <h3> <b>Abierta por:</b>{{$usuarioApertura}}</h3>

                <h3> <b>Fecha de Apertura:</b>{{$fechaApertura}}</h3>
                {{--
                <hr class="mt-0" style="background-color: rgba(9, 157, 255, 0.534); height: 3px;"> --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="m-4 p-4">
                <table>
                    <tbody>
                        <tr>
                            <td class="text-right">
                                <h3> Transacciones del Dia: </h3>
                            </td>
                            <td class="text-right">
                                <h3> Bs. {{$hoyTransacciones}}</h3>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td class="text-right">
                                <h3> Esperado en Efectivo: </h3>
                            </td>
                            <td class="text-right">
                                <h3> Bs. {{$saldoAcumulado}}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                <h3>Efectivo Actual:</h3>
                            </td>
                            <td class="text-right"> <input type="number" style="direction: rtl;" class="form-control"
                                    wire:model='efectivo_actual'></td>
                            <td>

                                <button class="boton-verde p-1" title="Contar Billetes y Monedas" data-toggle="modal"
                                    data-target="#contador_monedas">
                                    <i class="fas fa-calculator"></i>
                                </button>
                            </td>

                        </tr>

                        <br>
                        <tr>
                            <td class="text-right">
                                <h3>{{$efectivo_actual>$saldoAcumulado ? 'Efectivo Sobrante:':'Efectivo Faltante: '}}
                                </h3>
                            </td>
                            <td class="text-right">
                                <h3> Bs. {{$efectivo_actual-$saldoAcumulado}}</h3>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>

                                <h3 class="text-right"> Recaudar Fondos: </h3>
                            </td>
                            <td>
                                <div class="ml-4">

                                    <label class="switch">
                                        <input type="checkbox" wire:click='mostrar()'>
                                        <span class="slider round"></span>
                                    </label>
                                </div>


                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Nuevo Saldo Efectivo: </h3>
                            </td>
                        </tr> --}}


                        {{-- @if ($showDiv)

                        <tr>
                            <td>
                                <h3 class="text-right">Monto limite Efectivo:</h3>
                            </td>
                            <td>
                                <h3 class="text-right">{{$monto_limite}}</h3>
                            </td>

                        </tr>
                        <tr>
                      
                                
                            <td>
                                <h3 class="text-right">Efectivo Excedente:</h3>
                            </td>
                            <td>
                                <h3 class="text-right">{{$monto_limite}}</h3>
                            </td>
                    
                        </tr>
                        <tr>
                            <td>
                                <h3 class="text-right">Recaudo:</h3>
                            </td>
                            <td>
                                <input type="number" class="form-control" wire:model='recaudo' style="direction: rtl;">
                            </td>
                        </tr>
                        @endif --}}
                    </tbody>
                </table>
            </div>




        </div>

        <div class="row justify-content-center">
            <button type="button" class="btn btn-lg btn-warning" wire:click='cerrarCaja()'>Cerrar Caja</button>
        </div>
    </div>



    @include('livewire.cajas.contador')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('cerrarContador', msg => {
            $('#contador_monedas').modal('hide');

        });
    })

</script>