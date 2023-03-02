@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white mb-4"><a class="opacity-5 text-white"
                    href="{{url("")}}">Inicio</a>
            </li>
     
        </ol>

    </nav> 
@endsection



<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">










                            <div class="col-7 text-start">
                                <p class="text-sm mb-1 text-uppercase font-weight-bold">Ventas</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Bs {{ number_format($total_current_month, 2, ',', '.') }}
                                </h5>
                                <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">
                                    
                                    @if($difference_percentage > 0)
                                    + {{ number_format($difference_percentage, 2, ',', '.') }}%
                                    @else
                                    - {{ number_format($difference_percentage, 2, ',', '.') }}%
                                    @endif

                                    <span class="font-weight-normal text-secondary">desde el mes pasado</span>
                                </span>
                            </div>








                            <div class="col-5">
                                <div class="dropdown text-end">
                                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{-- <span class="text-xs text-secondary">6 May - 7 May</span> --}}
                                    </a>
                                    {{-- <ul class="dropdown-menu dropdown-menu-end px-2 py-3"
                                        aria-labelledby="dropdownUsers1">
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7
                                                days</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last week</a>
                                        </li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30
                                                days</a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-7 text-start">
                                <p class="text-sm mb-1 text-uppercase font-weight-bold">Clientes</p>
                                <h5 class="font-weight-bolder mb-0">
                                    30
                                </h5>
                                <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">+12% <span
                                        class="font-weight-normal text-secondary">desde el mes pasado</span></span>
                            </div>
                            <div class="col-5">
                                <div class="dropdown text-end">
                                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{-- <span class="text-xs text-secondary">6 May - 7 May</span> --}}
                                    </a>
                                    {{-- <ul class="dropdown-menu dropdown-menu-end px-2 py-3"
                                        aria-labelledby="dropdownUsers2">
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7
                                                days</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last week</a>
                                        </li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30
                                                days</a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-7 text-start">
                                <p class="text-sm mb-1 text-uppercase font-weight-bold">Ganancias</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Bs 140
                                </h5>
                                <span class="font-weight-normal text-secondary text-sm"><span
                                        class="font-weight-bolder">+Bs. 3.698</span> desde el mes pasado</span>
                            </div>
                            <div class="col-5">
                                <div class="dropdown text-end">
                                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers3"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{-- <span class="text-xs text-secondary">6 May - 7 May</span> --}}
                                    </a>
                                    {{-- <ul class="dropdown-menu dropdown-menu-end px-2 py-3"
                                        aria-labelledby="dropdownUsers3">
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7
                                                days</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last week</a>
                                        </li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30
                                                days</a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4 col-sm-6">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Procedencia Clientes</h6>
                            {{-- <button type="button"
                                class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                data-bs-original-title="See traffic channels">
                                <i class="fas fa-info" aria-hidden="true"></i>
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body pb-0 p-3 mt-4">
                        <div class="row">
                            <div class="col-7 text-start">
                                <div class="chart">
                                    <canvas id="chart-pie" class="chart-canvas" height="200" width="161"
                                        style="display: block; box-sizing: border-box; height: 200px; width: 161.5px;"></canvas>
                                </div>
                            </div>
                            <div class="col-5 my-auto">
                                <span class="badge badge-md badge-dot me-4 d-block text-start">
                                    <i class="bg-info"></i>
                                    <span class="text-dark text-xs">Facebook</span>
                                </span>
                                <span class="badge badge-md badge-dot me-4 d-block text-start">
                                    <i class="bg-primary"></i>
                                    <span class="text-dark text-xs">Volantes</span>
                                </span>
                                <span class="badge badge-md badge-dot me-4 d-block text-start">
                                    <i class="bg-dark"></i>
                                    <span class="text-dark text-xs">Venta</span>
                                </span>
                            
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <div class="w-60">
                            <p class="text-sm">
                               Mas del 50% de los clientes proviene de Facebook
                            </p>
                        </div>
                        <div class="w-40 text-end">
                            <a class="btn bg-light mb-0 text-end" href="javascript:;">Ir Clientes</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                       
                        <div class="d-flex align-items-center">
                            <span class="badge badge-md badge-dot me-4">
                                <i style="background-color: #5e72e4"></i>
                                <span class="text-dark text-xs">COMPRAS</span>
                            </span>
                            <span class="badge badge-md badge-dot me-4">
                                <i class="bg-dark"></i>
                                <span class="text-dark text-xs">VENTAS</span>
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300" width="644"
                                style="display: block; box-sizing: border-box; height: 300px; width: 644px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Ingresos y Egresos</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-bar" class="chart-canvas" height="300" width="644"
                                style="display: block; box-sizing: border-box; height: 300px; width: 644px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Ventas por Usuario</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group list-group-flush list my--3">
                            <li class="list-group-item px-0 border-0">
                                <div class="row align-items-center">
                           
                                    <div class="col">
                                        <p class="text-xs font-weight-bold mb-0">Usuario:</p>
                                        <h6 class="text-sm mb-0">Miguel Gonzalez</h6>
                                    </div>
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Ventas:</p>
                                        <h6 class="text-sm mb-0">2500</h6>
                                    </div>
                                  
                                </div>
                                <hr class="horizontal dark mt-3 mb-1">
                            </li>
                            <li class="list-group-item px-0 border-0">
                                <div class="row align-items-center">
                               
                                    <div class="col">
                                        <p class="text-xs font-weight-bold mb-0">Usuario:</p>
                                        <h6 class="text-sm mb-0">Mario Alcazar</h6>
                                    </div>
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Ventas:</p>
                                        <h6 class="text-sm mb-0">3200</h6>
                                    </div>
                                </div>
                                <hr class="horizontal dark mt-3 mb-1">
                            </li>
                            <li class="list-group-item px-0 border-0">
                                <div class="row align-items-center">
                                   
                                    <div class="col">
                                        <p class="text-xs font-weight-bold mb-0">Usuario:</p>
                                        <h6 class="text-sm mb-0">Jose Dominguez</h6>
                                    </div>
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Ventas:</p>
                                        <h6 class="text-sm mb-0">6300</h6>
                                    </div>
                                </div>
                                <hr class="horizontal dark mt-3 mb-1">
                            </li>
                            <li class="list-group-item px-0 border-0">
                                <div class="row align-items-center">
                                    
                                    <div class="col">
                                        <p class="text-xs font-weight-bold mb-0">Usuario:</p>
                                        <h6 class="text-sm mb-0">Carla Ortiz</h6>
                                    </div>
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Ventas:</p>
                                        <h6 class="text-sm mb-0">6500</h6>
                                    </div>
                                </div>
                                <hr class="horizontal dark mt-3 mb-1">
                            </li>
                            <li class="list-group-item px-0 border-0">
                                <div class="row align-items-center">
                               
                                    <div class="col">
                                        <p class="text-xs font-weight-bold mb-0">Usuario:</p>
                                        <h6 class="text-sm mb-0">Maria Jose</h6>
                                    </div>
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Ventas:</p>
                                        <h6 class="text-sm mb-0">125</h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Productos Mas Vendidos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nombre Producto</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Precio de Venta</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Costo</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/blue-shoe.jpg"
                                                        class="avatar me-3" alt="image">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Nike v22 Running</h6>
                                                    <p class="text-sm font-weight-bold text-secondary mb-0"><span
                                                            class="text-success">85</span> Ordenes</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Bs. 130</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">Bs. 95</p>
                                        </td>
                                      
                                    </tr>
                               
                              
                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>2022,
                            made with <i class="fa fa-heart" aria-hidden="true"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>









</div>


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}


<script src="./assets/js/core/bootstrap.min.js"></script>



<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script>
       var ctx1 = document.getElementById("chart-line").getContext("2d");
    var ctx2 = document.getElementById("chart-pie").getContext("2d");
    var ctx3 = document.getElementById("chart-bar").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228,0)'); //purple colors

    var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);
    var ventas={{ Js::from($ventas) }};
    var compras={{ Js::from($compras) }};
    var meses={{ Js::from($meses) }};

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    // Line chart
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: meses,
        datasets: [{
            label: "Compras",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 2,
            pointBackgroundColor: "#5e72e4",
            borderColor: "#5e72e4",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: compras,
            maxBarThickness: 6
          },
          {
            label: "Ventas",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 2,
            pointBackgroundColor: "#3A416F",
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data:ventas ,
            maxBarThickness: 6
          }
        ],
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
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: true,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#9ca2b7',
              padding: 10
            }
          },
        },
      },
    });


    // Pie chart
    new Chart(ctx2, {
      type: "pie",
      data: {
        labels: ['Facebook', 'Volantes', 'Venta'],
        datasets: [{
          label: "Projects",
          weight: 9,
          cutout: 0,
          tension: 0.9,
          pointRadius: 2,
          borderWidth: 2,
          backgroundColor: ['#17c1e8', '#5e72e4', '#3A416F'],
          data: [15, 20, 12],
          fill: false
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
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false,
            }
          },
        },
      },
    });

    // {
    //         label: "Ventas",
    //         tension: 0.4,
    //         borderWidth: 0,
    //         pointRadius: 2,
    //         pointBackgroundColor: "#3A416F",
    //         borderColor: "#3A416F",
    //         borderWidth: 3,
    //         backgroundColor: gradientStroke2,
    //         fill: true,
    //         data: [10, 30, 40, 120, 150, 220, 280, 250, 280],
    //         maxBarThickness: 6
    //       }

    // Bar chart
    new Chart(ctx3, {
      type: "bar",
      data: {
        labels: ["Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        datasets: [{
          label: "Ingresos",
          weight: 5,
          borderWidth: 0,
          borderRadius: 4,
          backgroundColor: '#5e72e4',
          data: [15, 20, 12, 60, 20, 15,25],
          fill: false,
          maxBarThickness: 35
        },
        {
          label: "Egresos",
          weight: 5,
          borderWidth: 0,
          borderRadius: 4,
          backgroundColor: '#3A416F',
          data: [10, 5, 12, 30, 20, 15,95],
          fill: false,
          maxBarThickness: 35
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
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: true,
              drawTicks: true,
            },
            ticks: {
              display: true,
              color: '#9ca2b7',
              padding: 10
            }
          },
        },
      },
    });
  </script>


