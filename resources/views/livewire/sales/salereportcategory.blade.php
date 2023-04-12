
@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ventas</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Reporte Categoria </h6>
    </nav>
@endsection


@section('Ventascollapse')
    nav-link
@endsection


@section('Ventasarrow')
    true
@endsection


@section('ventasagrupadasnav')
    "nav-link active"
@endsection


@section('Ventasshow')
    "collapse show"
@endsection

@section('ventasagrupadasli')
    "nav-item active"
@endsection

@section("css")
<link rel="stylesheet" href="{{ asset('apexcharts/apexcharts.css') }}">
<script src="{{ asset('apexcharts/apexcharts.min.js') }}"></script>
@endsection

<div>
    <div class="row">
        <div class="card-header">
            <div class="d-lg-flex mb-4">
                <h5 class="text-white text-sm">
                    Reporte por Categoria
                </h5>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <span class="text-sm">
                                <b>Fecha Inicio</b>
                            </span>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-3">
                            <span class="text-sm">
                                <b>Fecha Fin</b>
                            </span>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            

                            <div id="chart"></div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('javascript')
    <script>
        var chartOptions = {!! $chartOptions !!};

        var chart = new ApexCharts(document.querySelector("#chart"), chartOptions);

        chart.render();
    </script>
@endsection