<div>
    <div class="row">
        <p><h2 class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 1.5rem; font-weight:650">PUNTO DE VENTA / {{$nombrecaja}}</h2> </p>
            
    </div>
    <div class="row justify-content-start">
        <div class="col-lg-12">

            <h3>Abierta por: Roscio</h3>
            <br>
            <h3>Fecha de Apertura: 25/11/2022</h3>
            <hr>
        </div>

        <div>
            <table>
                <tbody>
                    <tr>
                        <td  class="text-right"> <h3>Total Transacciones Hoy:</h3></td>
                        <td> <h3> Bs. 1236</h3> </td>
                    </tr>
                    <tr>
                        <td class="text-right"><h3>Esperado en Efectivo: </h3></td>
                        <td> <h3>  Bs. 1521</h3></td>
                    </tr>
                    <tr>
                        <td  class="text-right"><h3>Efectivo Actual:</h3></td>
                        <td> <h3> Bs. 1236</h3> </td>
                     
                    </tr>
                    <tr>
                        <td>
                            <button class="boton-verde p-1" title="Calcular stock">
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
