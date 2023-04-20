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
        <h6 class="font-weight-bolder mb-0 text-white"> Ventas a Crédito </h6>
    </nav>
@endsection


@section('Ventascollapse')
    nav-link
@endsection


@section('Ventasarrow')
    true
@endsection


@section('ventasnoagrupadasnav')
    "nav-link active"
@endsection


@section('Ventasshow')
    "collapse show"
@endsection

@section('ventasnoagrupadasli')
    "nav-item active"
@endsection
<div>
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-end">
                    <button class="btn btn-primary">
                        Nueva Venta a Crédito
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5">
        <div class="card-body">
            <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-sm">No</th>
                        <th class="text-sm">Código</th>
                        <th class="text-sm">Cliente</th>
                        <th class="text-sm">Sucursal</th>
                        <th class="text-sm">Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">1</p>
                        </td>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-xs">SDFS959</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">Carlos Luna Perez</p>
                        </td>
                        <td>
                          <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="text-dark text-xs">Sucursal Central</span>
                          </span>
                        </td>
                        <td>
                          <span class="text-sm">
                            Activo
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                </div>
        </div>
    </div>
</div>
