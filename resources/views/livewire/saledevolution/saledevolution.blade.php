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
        <h6 class="font-weight-bolder mb-0 text-white"> Devolucion en Ventas </h6>
    </nav>
@endsection


@section('Ventascollapse')
    nav-link
@endsection


@section('Ventasarrow')
    true
@endsection


@section('devonav')
    "nav-link active"
@endsection


@section('Ventasshow')
    "collapse show"
@endsection

@section('devoli')
    "nav-item active"
@endsection
<div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <span class="text-sm"><b>Buscar Lista de Productos:</b></span>
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar productos...">
                </div>
                <div class="col-3">
                    <span class="text-sm"><b>Buscar Productos devueltos:</b></span>
                    <input wire:model="search_devolution" type="text" class="form-control"
                        placeholder="Buscar devoluciones...">
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-4">
            <div class="card">

                <div class="card-body">
                    <h5 class="text-center" style="background-color: rgb(255, 255, 255)); color: rgb(0, 0, 0);"><b>Lista de productos</b>
                        </h5>
                    @if ($list_products)
                        <div class="table-responsive">

                            <table class="table">

                                <tr>
                                    <th class="text-sm text-center">Nombre Producto</th>
                                    <th class="text-sm">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_products as $p)
                                        <tr>
                                            <td class="text-sm">
                                                {{ $p->nombre }}
                                            </td>
                                            <td class="text-sm">
                                                <button wire:click="showmodalsalelist({{ $p->id }})"
                                                    type="button" class="btn btn-xs btn-primary mb-0">
                                                    <i class="fas fa-plus pe-2" aria-hidden="true"></i></button>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $list_products->links() }}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                        <b>Lista de productos devueltos</b>
                        </h5>
                    <div class="table-responsive">
                        <table class="table">

                            <thead>
                                <tr>
                                    <th class="text-sm text-center">No</th>
                                    <th class="text-sm text-center">Producto</th>
                                    <th class="text-sm text-center">Cantidad</th>
                                    <th class="text-sm text-center">Usuario</th>
                                    <th class="text-sm text-center">Sucursal</th>
                                    <th class="text-sm text-center">fecha devolucion</th>
                                    <th class="text-sm text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devolution_list as $d)
                                    <tr class="text-sm">
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $d->nombre_prod }}
                                        </td>
                                        <td class="text-center">
                                            {{ $d->cantidad }}
                                        </td>
                                        <td>
                                            {{ $d->nombre_u }}
                                        </td>
                                        <td>
                                            {{ $d->nombre_su }}
                                        </td>
                                        <td class="text-center">

                                            {{ \Carbon\Carbon::parse($d->fecha)->format('d/m/Y') }}
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-xs btn-danger mb-0">
                                                <i class="fa fa-trash-o fa-6" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-xs btn-primary mb-0">
                                                <i class="fas fa-magic " aria-hidden="true"></i></button>
                                         

                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $devolution_list->links() }}

                </div>
            </div>
        </div>
    </div>

    @include('livewire.saledevolution.modalsalelist')
    @include('livewire.saledevolution.modaldevolution')
</div>

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //Mostrar ventana modal detalle venta
            window.livewire.on('show-modalsalelist', msg => {

                $('#Modalsalelist').modal('show')
            });

            window.livewire.on('hide-modalsalelist', msg => {
                $('#Modalsalelist').modal('hide')
            });

            window.livewire.on('show-modaldevolution', msg => {

                $('#modaldevolution').modal('show')
            });
            window.livewire.on('hide-modaldevolution', msg => {

                $('#modaldevolution').modal('hide')
            });

            window.livewire.on('message-warning', msg => {

                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    padding: '2em'
                });
                toast({
                    type: 'warning',
                    title: 'Cantidad superada',
                    padding: '2em',
                })
            });

        });
    </script>
@endsection
