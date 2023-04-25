<div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <span class="text-sm"><b>Buscar:</b></span>
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar productos...">
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre Producto</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_products as $p)
                                    <tr>
                                        <td>
                                            {{ $p->nombre }}
                                        </td>
                                        <td>
                                            <button wire:click="showmodalsalelist({{ $p->id }})" type="button"
                                                class="btn btn-primary btn-sm"><i class="fas fa-plus"
                                                    aria-hidden="true"></i></button>

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
