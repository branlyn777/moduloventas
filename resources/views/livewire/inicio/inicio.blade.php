@section('css')

    <style>
        .zoom {
        transition: transform .3s; /* Animation */
        cursor: pointer;
        }
        .zoom:hover {
        transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
</style>
    
@endsection
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">

   
        <div class="row">
            <div class="col-md-3">
                <div class="card card-dark bg-primary-gradient zoom">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-right">{{round($difVenta)}}%</div>
                        <h2 class="mb-2">Bs. {{$ventasMes}}</h2>
                        <p>Total Ventas Mes</p>
                        <div class="pull-in sparkline-fix chart-as-background">
                            <div id="lineChart"><canvas width="511" height="70" style="display: inline-block; width: 511.656px; height: 70px; vertical-align: top;"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dark bg-secondary-gradient zoom">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-right">{{round($difCompra)}}%</div>
                        <h2 class="mb-2">Bs. {{$comprasMes}}</h2>
                        <p>Total Compras Mes</p>
                        <div class="pull-in sparkline-fix chart-as-background">
                            <div id="lineChart2"><canvas width="511" height="70" style="display: inline-block; width: 511.656px; height: 70px; vertical-align: top;"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dark bg-success2 zoom">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-right">{{round($difIngresos)}}%</div>
                        <h2 class="mb-2">Bs. {{$ingresosMes}}</h2>
                        <p>Ingresos</p>
                        <div class="pull-in sparkline-fix chart-as-background">
                            <div id="lineChart3"><canvas width="511" height="70" style="display: inline-block; width: 511.656px; height: 70px; vertical-align: top;"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dark bg-info zoom">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-right">{{round($difIngresos)}}%</div>
                        <h2 class="mb-2">Bs. {{$egresosMes}}</h2>
                        <p>Egresos</p>
                        <div class="pull-in sparkline-fix chart-as-background">
                            <div id="lineChart3"><canvas width="511" height="70" style="display: inline-block; width: 511.656px; height: 70px; vertical-align: top;"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    <br>





   

        {{-- <div class="col-12 col-sm-6 col-md-3 text-center">
          
            <div class="zoom" style="background-color: #02b1ce;">
                <h2><b>LISTA VENTAS</b></h2>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
          
            <div class="zoom" style="background-color: #02b1ce;">
                <h2><b>PERMISOS</b></h2>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
      
            <div class="zoom" style="background-color: #02ce02;">
                <h2><b>ASIGNAR PERMISOS</b></h2>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
  
            <div class="zoom" style="background-color: #172022;">
                <h2><b>CARTERAS</b></h2>
            </div>
        </div> --}}

        <div class="row justify-content-center ml-4">
            <div class="col-lg-12">

                <div class="row">
                   
                    <div class="col-lg-6">
                        <div class="row">

                            <div class="col-lg-12">
        
                                <h2>Compras y Ventas</h2>
                            </div>
                            <canvas id="myChart" height="auto" width='auto'></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">

                            <div class="col-lg-12">
        
                                <h2>Ingresos y Egresos</h2>
                            </div>
                            <canvas id="myChart2" height="auto" width='auto'></canvas>
                        </div>
                    </div>

    
                </div>
            </div>
        

            
          
        </div>
        {{-- <div class="row">
            <h1>Ventas</h1>
            <canvas id="myChart" height="100px"></canvas>

            
          
        </div> --}}

</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  
    // var labels =  {{ Js::from($labels) }};
    var ventas =  {{ Js::from($ventas) }};
    var compras =  {{ Js::from($compras) }};
    var ingresos =  {{ Js::from($ingresos) }};
    var egresos =  {{ Js::from($egresos) }};
    const labels = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Sept.',
    'Oct.',
    'Nov.',
    'Dic.'
  
];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Venta Bs.',
            backgroundColor: '#02b1ce',
            borderColor: '#02b1ce',
            data: ventas,
            
        },
        {
            label: 'Compra Bs.',
            backgroundColor: '#172022',
            borderColor: '#172022',
            data: compras,
    }]
     
    };
  
    const config = {
        type: 'line',
        data: data,
        options: {}
    };


  
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );



//Grafico de Ingresos y egresos



    const labels2 = [
        'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Sept.',
    'Oct.',
    'Nov.',
    'Dic.'
];
    const data2 = {
        labels: labels2,
        datasets: [{
            label: 'Ingresos Bs.',
            backgroundColor: '#02ce02',
            borderColor: '#02ce02',
            data: ingresos
        },
        {
            label: 'Egresos Bs.',
            backgroundColor: '#172022',
            borderColor: '#172022',
            data: egresos
    }]
     
    };
  
    const configs = {
        type: 'line',
        data: data2,
        options: {}
    };


  
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        configs
    );
  
</script>