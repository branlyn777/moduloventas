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
                        <p>Total Compras Mesfgg</p>
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
                            <div class="card-body p-3">
                                <div class="chart">
                                  {{-- <canvas id="chart-line" class="chart-canvas" height="300"></canvas> --}}
                                  <canvas id="myChart" class="chart-canvas" height="300" width='auto'></canvas>
                                </div>
                              </div>
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

<script src="./assets/js/core/popper.min.js"></script>
<script src="./assets/js/core/bootstrap.min.js"></script>
<script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>


<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script type='text/javascript'>
//    var compras =  {{ Js::from($compras) }};



var ctx1 = document.getElementById("myChart").getContext("2d");

var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

var ventas = <?php echo json_encode($ventas);?>;


console.log(ventas);

new Chart(ctx1, {
  type: "line",
  data: {
    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Mobile apps",
      tension: 0.4,
      borderWidth: 0,
      pointRadius: 0,
      borderColor: "#02b1ce",
      backgroundColor: gradientStroke1,
      borderWidth: 3,
      fill: true,
      data:[5,8,9,5,3],
      maxBarThickness:6

    }],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      }
    },
    interaction: {
      intersect: false,
      mode: 'index',
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: true,
          drawOnChartArea: true,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          padding: 10,
          color: '#fbfbfb',
          font: {
            size: 11,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
        }
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          color: '#ccc',
          padding: 20,
          font: {
            size: 11,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
        }
      },
    },
  },
});

  

  
</script>