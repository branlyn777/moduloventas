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
        <h6 class="font-weight-bolder mb-0 text-white"> Reporte Mes </h6>
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

@section('css')
    <link rel="stylesheet" href="{{ asset('apexcharts/apexcharts.css') }}">
    <script src="{{ asset('apexcharts/apexcharts.min.js') }}"></script>
@endsection

<div class="card mb-4"> <br>
    <div style="padding-left: 15px; padding-right: 15px;">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-2 text-left">
                <h6 class="mb-0">
                    Seleccionar Usuario:
                </h6>
                <div class="form-group">
                    <select wire:model="user_id" class="form-select">
                        <option value="todos" selected>Todos</option>
                        @foreach ($listausuarios as $u)
                            <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}</option>
                        @endforeach


                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-2 text-left">
                <h6 class="mb-0">
                    Seleccionar Año:
                </h6>
                <div class="form-group">
                    <select wire:model="categoria_id" class="form-select">
                        <option value="Todos" selected>
                        </option>

                    </select>
                </div>
            </div>
            <button wire:click="$emit('asd')">
                enviar
            </button>


        </div>
    </div>
</div>


<div class="card" style="width: 70rem;">
    <div class="card-body">
        <div id="chart"></div>
    </div>
</div>
@section('javascript')


<script>
    document.addEventListener('livewire:load', function () {




      Livewire.on('asd', function (data) {


       







        var options = {
          series: [{
          name: 'Net Profit',
          data:  @this.months,
        },],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Ene','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
      
      


















      });





    });

</script>


@endsection
