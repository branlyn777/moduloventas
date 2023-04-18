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
                        <option value="todos">Todos</option>
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
                  <select wire:model="year" class="form-select">
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                  </select>
              </div>
            </div>
          <div class="col-12 col-sm-6 col-md-2 text-left">
            <span>|</span>
            <br>
              <button wire:click="actualizar()" class="btn btn-primary">
                Aplicar
              </button>
          </div>
        </div>
    </div>
</div>


<div class="card" style="width: 70rem;">
    <div class="card-body">
        

      <div class="chart">
        <canvas id="chart-line" class="chart-canvas" height="500" width="809"></canvas>
      </div>
      


    </div>
</div>
@section('javascript')


<script>
    document.addEventListener('livewire:load', function () {





       







        var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        datasets: [{
          label: "Total Ventas BS",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: @this.months,
          maxBarThickness: 6

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
      
      
      
      






















    });

</script>


@endsection