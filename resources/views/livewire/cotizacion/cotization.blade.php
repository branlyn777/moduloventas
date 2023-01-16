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
        <h6 class="font-weight-bolder mb-0 text-white"> Cotización </h6>
    </nav>
@endsection


@section('Reportescollapse')
    nav-link
@endsection


@section('Reportesarrow')
    true
@endsection


@section('cotizationnav')
    "nav-link active"
@endsection


@section('Reportesshow')
    "collapse show"
@endsection

@section('cotizationli')
    "nav-item active"
@endsection


<div>

    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Cotizaciones</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">

                        <button {{-- wire:click="modalbuscarcliente()" --}} class="btn btn-add mb-0"
                            style="background-color: #2e48dc; color: white;">
                            <i class="fas fa-plus me-2"></i>
                            Nueva cotización
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
