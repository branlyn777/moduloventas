@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white mb-4"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a>
            </li>
        </ol>
    </nav>
@endsection
@section('css')
    
@endsection
<div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($branchs as $b)
            <div class="col mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-12 text-start">
                                
                                
                                
                                
                                
                                <p class="text-sm mb-1 text-uppercase font-weight-bold">VENTAS MES ACTUAL - {{$b->name}}</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ number_format($b->total_current_month, 2, ',', '.') }} Bs
                                    </h5>
                                    @if ($percentage < 100)
                                        <span class="text-sm text-end text-danger font-weight-bolder mt-auto mb-0">
                                            {{ number_format($b->percentage, 2, ',', '.') }}%
                                            <span class="font-weight-normal text-secondary">
                                                del total del mes anterior
                                                ({{ number_format($b->previous_month_total, 2, ',', '.') }} Bs)
                                            </span>
                                        </span>
                                    @else
                                        <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">
                                            +{{ number_format($b->percentage, 2, ',', '.') }}%
                                            <span class="font-weight-normal text-secondary">
                                                del total del mes anterior
                                                ({{ number_format($b->previous_month_total, 2, ',', '.') }} Bs)
                                            </span>
                                        </span>
                                    @endif










                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach
            <div class="col mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-7 text-start">
                                <p class="text-sm mb-1 text-uppercase font-weight-bold">Nuevos Clientes</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $clientesnuevos }}
                                </h5>
                                <span
                                    class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">{{ $porcentajeclientes == 100 ? '-- ' : number_format($porcentajeclientes, 0) }}%<span
                                        class="font-weight-normal text-secondary">desde el mes pasado</span></span>
                            </div>
                            <div class="col-5">
                                <div class="dropdown text-end">
                                    <a href="javascript:;" class="cursor-pointer text-primary" id="dropdownUsers2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user-group"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->hasRole('Administrador'))
                <div class="col mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-7 text-start">
                                    <p class="text-sm mb-1 text-uppercase font-weight-bold">Utilidades del mes</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $ganancias }}
                                    </h5>
                                    <span class="font-weight-normal text-secondary text-sm"><span
                                            class="font-weight-bolder">{{ $porcentajeganancias == 100 ? '-- ' : number_format($porcentajeganancias, 2) }}%</span>
                                        desde el mes pasado</span>
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
            @endif
        </div>
        <div class="row mt-4">

            <div class="col-lg-8 mt-sm-0 mt-4">
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
                            <canvas id="chart-line" class="chart-canvas" height="390" width="644"
                                style="display: block; box-sizing: border-box; height: 340px; width: 644px;"></canvas>
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
                    <div class="card-body p-3" style="display: block; box-sizing: border-box; height: 375px;">
                        <ul class="list-group list-group-flush list my--3">
                            @forelse ($ventasusuario as $key=>$value)
                                <li class="list-group-item px-0 border-0">
                                    <div class="row align-items-center">


                                        <div class="col">
                                            <p class="text-xs font-weight-bold mb-0">Usuario:</p>
                                            <h6 class="text-sm mb-0">{{ $key }}</h6>
                                        </div>
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Ventas:</p>
                                            <h6 class="text-sm mb-0">{{ $value }}</h6>
                                        </div>


                                    </div>
                                    <hr class="horizontal dark mt-3 mb-1">
                                </li>
                            @empty
                                <p>Sin datos que visualizar</p>
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex">
                            <h6 class="me-auto">Ingresos y Egresos por Categoria</h6>
                        </div>
                    </div>
                    <div class="card-body pb-0 p-3 mt-4">
                        <div class="row">
                            <div class="col">
                                <div class="row">

                                    <div class="col-md-7 text-start">
                                        <div class="chart">
                                            <canvas id="chart-pie" class="chart-canvas"
                                                style="display: block; box-sizing: border-box; height: 320px; width: 161.5px;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-md-5 m-auto">
                                        @foreach ($labelingresos as $item)
                                            <li class="text-xs">{{ $item }}</li>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="chart">
                                            <canvas id="chart-pie-egresos" class="chart-canvas"
                                                style="display: block; box-sizing: border-box; height: 250px; width: 300.5px;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-md-5 m-auto">
                                        @foreach ($labelegresos as $item)
                                            <li class="text-xs">{{ $item }}</li>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Ingresos y Egresos por Mes</h6>
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
        </div>

        {{-- grafica procedencia cliente --}}

        <div class="row mt-4">
            <div class="col-lg-4 col-sm-6">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Procedencia Cliente</h6>
                        </div>
                    </div>
                    <div class="card-body pb-0 p-3 mt-4">
                        <div class="row">
                            <div class="col-7 text-start">
                              
                                <div class="chart">
                                    <canvas id="chart-doughnut" class="chart-canvas"width="800" height="600"
                                        style="display: block; box-sizing: border-box; height: 220px; width: 200.5px; text-alingt: center"></canvas>
                                </div>
                                
                            </div>
                            <div class="col-5 my-auto">
                                @foreach ($origins as $no)
                                    <span class="badge badge-md badge-dot me-4 d-block text-start">
                                        <i class="bg-info"></i>
                                        <span class="text-dark text-xs">{{ $no->procedencia }}</span>
                                    </span>
                                @endforeach
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-body pb-0 p-1 mt-1">
                        <div class="row">

                            <div class="col-4 text-start">

                                <div class="chart">

                                    <canvas id="chart-procedencia" class="chart-canvas" 
                                       
                                        style="display: block; box-sizing: border-box; height: 10px; width: 10px;"></canvas>
                                </div>
                            </div>
                            
                            
                            <div class="col-5 my-auto">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center">


                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Productos Mas Vendidos del Mes</h6>
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
                                            Un.Vendidas</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            En Bs.</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($productos_vendidos as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div>
                                                        @if ($item->prodimg != null)
                                                            <img src="{{ asset('storage/productos/' . $item->prodimg) }}"
                                                                alt="productos vendidos" width="50"
                                                                class="avatar me-3">
                                                        @else
                                                            <img src="{{ asset('storage/productos/' . 'noimagenproduct.png') }}"
                                                                width="50" class="avatar me-3"
                                                                alt="productos imagen">
                                                        @endif

                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->nombre }}</h6>
                                                        {{-- <p class="text-sm font-weight-bold text-secondary mb-0"><span
                                                                class="text-success">85</span> Ordenes</p> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->cantidad_vendida }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->total_vendido }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- grafica procedencia cliente --}}

        {{-- <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">


                    <div class="card-header pb-0">
                        <h6>Productos Mas Vendidos del Mes</h6>
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
                                            Un.Vendidas</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            En Bs.</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($productos_vendidos as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div>
                                                        @if ($item->prodimg != null)
                                                            <img src="{{ asset('storage/productos/' . $item->prodimg) }}"
                                                                alt="productos vendidos" width="50"
                                                                class="avatar me-3">
                                                        @else
                                                            <img src="{{ asset('storage/productos/' . 'noimagenproduct.png') }}"
                                                                width="50" class="avatar me-3"
                                                                alt="productos imagen">
                                                        @endif

                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->nombre }}</h6>
                                                         <p class="text-sm font-weight-bold text-secondary mb-0"><span
                                                                class="text-success">85</span> Ordenes</p> 
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->cantidad_vendida }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->total_vendido }}
                                                </p>
                                            </td>


                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            Desarrollado <i class="fa fa-computer" aria-hidden="true"></i> por
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">SIE</a>

                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
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
                    </div> --}}
                </div>
            </div>
        </footer>
    </div>









</div>


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}


<script src="./assets/js/core/bootstrap.min.js"></script>



<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script>
    var ctx = document.getElementById('chart-doughnut').getContext('2d');
    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var ctx2 = document.getElementById("chart-pie").getContext("2d");
    var ctx4 = document.getElementById("chart-pie-egresos").getContext("2d");
    var ctx3 = document.getElementById("chart-bar").getContext("2d");
    var ctx5 = document.getElementById("chart-procedencia").getContext("2");
    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228,0)'); //purple colors

    var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);
    var ventas = {{ Js::from($ventas) }};
    var compras = {{ Js::from($compras) }};
    var meses = {{ Js::from($meses) }};
    var ingresos = {{ Js::from($labelingresos) }};
    var egresos = {{ Js::from($labelegresos) }};
    var chtingresos = {{ Js::from($chartingresos) }};
    var chtegresos = {{ Js::from($chartegresos) }};
    var mesesbarras = {{ Js::from($mesesbarras) }};
    var bar_ingresos = {{ Js::from($ingresos) }};
    var bar_egresos = {{ Js::from($egresos) }};

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
                    data: ventas,
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



    // Pie chart of incomes and bills
    new Chart(ctx2, {
        type: "pie",
        data: {
            labels: ingresos,
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 0,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ["#5B34F8", "#2E3AD9", "#3A79F0", "#2995D9", "#2FDFF8", "#EE79F0",
                    "#F84370"
                ],
                data: chtingresos,
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
    new Chart(ctx4, {
        type: "pie",
        data: {
            labels: egresos,
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 0,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ["#8056F0", "#5A5BFA", "#5D81E3", "#5AAFFA", "#56D0F0", "#193545",
                    "#88F056", "#CC5AFA"
                ],
                data: chtegresos,
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


    // Bar chart
    new Chart(ctx3, {
        type: "bar",
        data: {
            labels: mesesbarras,
            datasets: [{
                    label: "Ingresos",
                    weight: 5,
                    borderWidth: 0,
                    borderRadius: 4,
                    backgroundColor: '#5e72e4',
                    data: bar_ingresos,
                    fill: false,
                    maxBarThickness: 35
                },
                {
                    label: "Egresos",
                    weight: 5,
                    borderWidth: 0,
                    borderRadius: 4,
                    backgroundColor: '#3A416F',
                    data: bar_egresos,
                    fill: false,
                    maxBarThickness: 35
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
        }
    });

    new Chart(ctx5, {
        type: "pie",
        data: {
            labels: @json($name_origin_client),
            datasets: [{
                label: "Projects",
                weight: 10,
                cutout: 0,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: @json($color_origin_client),
                data: @json($quantity_origin_client),
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
            
        },
    });

    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($name_origin_client),
            datasets: [{
                data: @json($quantity_origin_client),
                backgroundColor: [
                    '#36A2EB',
                    '#FF6384',
                    '#FFCE56',
                    '#a2eb36',
                    '#eb7f36',
                    '#3647eb',
                    '#36ebda',
                    '#ED4D5D',
                    '#1b2155'
                ],
                hoverBackgroundColor: [
                    '#36A2EB',
                    '#FF6384',
                    '#FFCE56',
                    '#a2eb36',
                    '#eb7f36',
                    '#3647eb',
                    '#36ebda',
                    '#ED4D5D',
                    '#1b2155'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },

        }
    });
</script>
