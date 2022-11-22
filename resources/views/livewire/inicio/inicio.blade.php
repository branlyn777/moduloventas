@section('css')

    <style>
        .zoom {
        padding: 10px;
        /* background-color: #ff0083; */
        transition: transform .3s; /* Animation */
        width: 200px;
        height: 100px;
        margin: 0 auto;
        border-radius: 15px;
        border: #ffffff solid 2px;
        color: white;
        /* text-align: center; */
        cursor: pointer;

        display:flex;
        justify-content: center;
        align-items: center;
        }

        .zoom:hover {
        transform: scale(1.3); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
</style>
    
@endsection
<div>

    <br>
    <br>
    <br>


    <div class="row">

        <div class="col-12 col-sm-6 col-md-3 text-center">
            {{-- <div class="zoom" style="background-color: #ff0083;"> --}}
            <div class="zoom" style="background-color: #02b1ce;">
                <h2><b>VENTAS</b></h2>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
            {{-- <div class="zoom" style="background-color: #009721;"> --}}
            <div class="zoom" style="background-color: #02b1ce;">
                <h2><b>INVENTARIOS</b></h2>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
            {{-- <div class="zoom" style="background-color: #972300;"> --}}
            <div class="zoom" style="background-color: #02b1ce;">
                <h2><b>CORTE DE CAJA</b></h2>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
            {{-- <div class="zoom" style="background-color: #972300;"> --}}
            <div class="zoom" style="background-color: #02b1ce;">
                <h2><b>COMPRAS</b></h2>
            </div>
        </div>


    </div>

    <br>
    <br>

    <div class="row">

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
      
            <div class="zoom" style="background-color: #02b1ce;">
                <h2><b>ASIGNAR PERMISOS</b></h2>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
  
            <div class="zoom" style="background-color: #02b1ce;">
                <h2><b>CARTERAS</b></h2>
            </div>
        </div> --}}

        <div class="row">
            <h1>Ventas</h1>
            <canvas id="myChart" height="100px"></canvas>

            
          
        </div>
        <div class="row">
            <h1>Ventas</h1>
            <canvas id="myChart" height="100px"></canvas>

            
          
        </div>

    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};
  
    const data = {
        labels: labels,
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: users,
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
  
</script>