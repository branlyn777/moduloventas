<div>
    <div class="row">
        <div class="col-lg-12">

            <h2 class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 1.5rem; font-weight:650">PUNTO DE VENTA / {{$nombrecaja}}</h2> 
            
            <h2 class="text-dark mb-0 pb-0" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 1.5rem; font-weight:500">Control de Efectivo</h2> 
            <hr class="mt-0" style="background-color: rgba(9, 157, 255, 0.534); height: 3px;">
            
        </div>
        

            
    </div>
   
    <div class="row justify-content-start">
        <div class="col-lg-12">

            <h3> <b>Abierta por:</b>  Roscio</h3>
  
            <h3> <b>Fecha de Apertura:</b>  25/11/2022</h3>
            <hr class="mt-0" style="background-color: rgba(9, 157, 255, 0.534); height: 3px;">

        </div>

        <div class="ml-3">
            <table>
                <tbody>
                    <tr>
                        <td  class="text-right"> <h3>Total Transacciones del Dia:</h3></td>
                        <td> <h3> Bs. 1236</h3> </td>
                    </tr>
                    <tr>
                        <td class="text-right"><h3>Esperado en Efectivo: </h3></td>
                        <td> <h3>  Bs. 1521</h3></td>
                    </tr>
                    <tr>
                        <td  class="text-right"><h3>Efectivo Actual:</h3></td>
                        <td> <h3> Bs. 1236</h3> </td>
                        <button class="boton-verde p-1" title="Contar Billetes y Monedas" data-toggle="modal"
                        data-target="#contador_monedas">
                            <i class="fas fa-calculator"></i>
                        </button>
                     
                    </tr>
                    <tr>
                        <td>
                            <button class="boton-verde p-1" title="Contar Billetes y Monedas" data-toggle="modal"
                            data-target="#contador_monedas">
                                <i class="fas fa-calculator"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
  

    </div>
    @include('livewire.cajas.contador')
</div>
