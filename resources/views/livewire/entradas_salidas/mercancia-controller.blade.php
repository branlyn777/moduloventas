<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5>Entrada y Salida de Productos</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    wire:click='resetui()' data-bs-target="#operacion">Registrar Operacion</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-lg-flex">
                        <div class="col-12 col-sm-12 col-md-3"></div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4 col-md-2">
                            <div class="ms-auto my-auto">
                                <select wire:model="tipo_de_operacion" class="form-control">
                                    <option value="Entrada">Entrada</option>
                                    <option value="Salida">Salida</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Fecha de Registro</th>
                                            <th>Almacen</th>
                                            <th class="text-center">Tipo Operacion</th>
                                            <th>Observacion</th>
                                            <th>Usuario</th>
                                            <th class="text-center">Acc.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ingprod as $data2)
                                        <tr>
                                            <td class="text-center">

                                                <h6>{{ ($ingprod->currentpage()-1) * $ingprod->perpage() + $loop->index
                                                    + 1 }}</h6>

                                            </td>
                                            <td>
                                                <center>

                                                    {{\Carbon\Carbon::parse($data2->created_at)->format('d-m-Y')}}
                                                    <br>
                                                    {{\Carbon\Carbon::parse($data2->created_at)->format('h:i:s a')}}
                                                </center>
                                            </td>

                                            <td>
                                                Sucursal {{$data2->destinos->sucursals->name}}
                                                {{$data2->destinos->nombre}}

                                            </td>
                                            <td class="text-center">
                                                {{$data2->concepto}}
                                            </td>
                                            <td>
                                                {{$data2->observacion}}
                                            </td>
                                            <td>
                                                {{$data2->usuarios->name}}
                                            </td>
                                            <td class="text-center">
                                                <center>
                                                    <a wire:click="ver({{ $data2->id }})" type="button"
                                                        class="text-primary  mx-2">

                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                    <a wire:click="verifySale({{ $data2->id }})" type="button"
                                                        class="text-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </center>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $ingprod->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('livewire.entradas_salidas.operacion')
    @include('livewire.entradas_salidas.buscarproducto')
</div>


@section('javascript')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('product-added', msg => {
            $('#operacion').modal('hide')
            
        });
        window.livewire.on('show-detail', msg => {
            $('#buscarproducto').modal('show')
            
        });

        window.livewire.on('venta', event => {
            swal(
                '¡No se puede eliminar el registro!',
                'Uno o varios de los productos de este registro ya fueron distribuidos y/o tiene relacion con varios registros del sistema.',
                'error'
                )
        });
  
        window.livewire.on('confirmar', event => {
         
            Swal.fire({
                title: 'Estas seguro de eliminar este registro?',
                text: "Esta accion es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
            if (result.value) {
            
                window.livewire.emit('eliminar_registro');
                Swal.fire(
                'Eliminado!',
                 'El registro fue eliminado con exito',
                'success'
                 )
             }
            })
				
            });
        window.livewire.on('confirmarAll', event => {
         
            Swal.fire({
                title: 'Estas seguro de eliminar este registro?',
                text: "Esta accion es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
            if (result.value) {
            
                window.livewire.emit('eliminar_registro_total');
                Swal.fire(
                'Eliminado!',
                 'El registro fue eliminado con exito',
                'success'
                 )
             }
            })
				
            });
            window.livewire.on('stock-insuficiente', event => {
        
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Stock insuficiente para la salida del producto en esta ubicacion.',
                padding: '2em',
            })
     });
  
    })
</script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection