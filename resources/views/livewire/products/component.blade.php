<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Todos los Productos</h5>
                            <p class="text-sm mb-0">
                            Lista de todos los productos registrados.
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="javascript:void(0)" class="btn bg-gradient-primary btn-sm mb-0" wire:click="$emit('modal-show')">
                                    +&nbsp; Nuevo Producto
                                </a>
                                <button wire:click="$emit('modal-import')" type="button" class="btn btn-outline-primary btn-sm mb-0">
                                Importar
                                </button>
                                <a href='{{url('productos/export/')}}' class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" type="button">
                                    Exportar
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-lg-flex">
                        <div class="col-12 col-sm-12 col-md-3">
                            @include('common.searchbox')
                        </div>
                    </div>
                    <div class="d-lg-flex">
                        <div class="dataTable-top">
                            {{-- <div class="dataTable-search">
                                <input wire:model="search" wire:keydown.enter="overrideFilter()" class="dataTable-input" placeholder="Buscar..." type="text">
                            </div> --}}
                        </div>
                        <div class="dataTable-dropdown">
                            {{-- <label> --}}
                                <select wire:model="pagination" class="dataTable-selector form-control">
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                </select>
                                
                            {{-- </label> --}}
                        </div>
                        <a wire:click= 'deleteProducts()' class="btn btn-outline-primary btn-sm mb-0">Eliminar Seleccionados</a>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table table-flush dataTable-table" id="products-list">
                                    <thead>
                                        <tr class="text-center">
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                <div class="d-flex">
                                                    <div class="form-check my-auto">
                                                        <input type="checkbox" class="form-check-input" wire:model="checkAll">
                                                    </div>
                                                    Producto
                                                </div>
                                            </th>
                                            <th style="width: 13.3259%;">
                                                Categoria
                                            </th>
                                            <th style="width: 10.3024%;">
                                                Sub Categoria
                                            </th>
                                            <th style="width: 13.4378%;">
                                                Codigo
                                            </th>
                                            <th style="width: 11.0862%;">
                                                Precio
                                            </th>
                                            <th style="width: 15.5655%;">
                                                Costo
                                            </th>
                                            <th style="width: 14.6697%;">
                                                Estado
                                            </th>
                                            <th style="width: 14.6697%;">
                                                Actiones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($data as $products)
                                        <tr>
                                            <td>
                                                {{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check my-auto">
                                                    <input class="form-check-input" type="checkbox" wire:model="selectedProduct" value="{{$products->id}}">
                                                    </div>
                                                    <img src="{{ asset('storage/productos/' . $products->imagen) }}" alt="hoodie" width="80">
                                                    <h6 class="ms-3 my-auto">{{$products->nombre}}</h6>
                                                </div>
                                            </td>
                                            <td class="text-sm">
                                                {{ $products->category->name}}
                                            </td>
                                            <td class="text-sm">
                                                @if ($products->category->subcat == null)
                                                    No definido
                                                @else
                                                    {{ $products->category->name}}
                                                @endif
                                            </td>
                                            <td class="text-sm">
                                                {{ $products->codigo}}
                                            </td>
                                            <td class="text-sm">
                                                {{ $products->precio_venta }}
                                            </td>
                                            <td class="text-sm">
                                                {{ $products->costo}}
                                            </td>
                                            <td>
                                                @if ($products->status== 'ACTIVO')
                                                <span class="badge badge-danger badge-sm">Activo</span>
                                                @else
                                                <span class="badge badge-success badge-sm">Inactivo</span>
                                                @endif
                                            </td>
                                            <td class="text-sm">
                                                <a href="javascript:void(0)" wire:click="Edit({{ $products->id }})" class="mx-3">
                                                    <i class="fas fa-edit text-dark opacity-8"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="Confirm('{{ $products->id }}','{{ $products->nombre }}',{{$products->destinos->count()}})">
                                                    <i class="fas fa-trash text-dark opacity-8"></i>
                                                </a>
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
        </div>
    </div>
    @include('livewire.products.form')
    @include('livewire.products.importarproductos')
</div>
@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('product-added', msg => {
            $('#theModal').modal('hide')
            $("#im").val('');
            noty(msg)
        });

        window.livewire.on('modal-import', msg => {
            $('#modalimport').modal('show')
        });

        window.livewire.on('product-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('product-deleted', msg => {
            noty(msg)
        });
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        });
        window.livewire.on('restriccionProducto', event => {
            swal(
                '¡No se puede eliminar el producto!',
                'El producto ' +@this.productError +' tiene relacion con otros registros del sistema.',
                'error'
                )
        });
    });

        function Confirm(id, name, products) {
        if (products > 0)
        {
            console.log(products);
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'El producto' + name + ' tiene relacion con otros registros del sistema, desea proseguir con la eliminacion de este ITEM?',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#383838',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'
            }).then(function(result){
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
            
            //este producto tiene varias relaciones activas con otros registros del sistema
        }

        else{
            swal.fire({
                title: 'CONFIRMAR',
                icon: 'warning',
                text: 'Este producto no tiene relacion con ningun registro del sistema, pasara a ser eliminado permanentemente. ',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#383838',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'
            }).then(function(result){
                if(result.value){
                    window.livewire.emit('deleteRowPermanently',id).Swal.close()
                }
            })
        }
       
    }
  
</script>

<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection