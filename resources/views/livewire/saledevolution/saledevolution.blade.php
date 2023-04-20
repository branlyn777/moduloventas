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
                                        {{$p ->nombre}}
                                    </td>
                                    <td>
                                        <button wire:click="showmodalsalelist({{$p ->id}})">+</button>
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
</div>

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //Mostrar ventana modal detalle venta
            window.livewire.on('show-modalsalelist', msg => {
                $('#Modalsalelist').modal('show')
            });
          
        });


    </script>
@endsection
