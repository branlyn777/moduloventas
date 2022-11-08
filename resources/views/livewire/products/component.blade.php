<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
               
    <div class="row">
        <div class="col-12 text-center">
            <p class="h2"><b>PRODUCTOS</b></p>
        </div>
    </div>
                <ul class="row justify-content-end">
                    <button type="button" class="boton-azul-g m-1" data-toggle="modal"
                        data-target="#theModal"> <i class="fas fa-plus-circle"></i>Agregar Productos</button>
                    <button type="button" class="boton-azul-g m-1" data-toggle="modal"
                        data-target="#modalimport"> <i class="fas fa-arrow-alt-circle-up"></i> Subir Productos</button>
                    <a href='{{url('productos/export/')}}' class="boton-azul-g m-1" > <i class="fas fa-arrow-alt-circle-up"></i> Exportar Excel</a>
                       
                    </ul>
                </div>
            <div class="row">
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="input-group mb-2 col-lg-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-gp">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" wire:model="search" placeholder="Buscar" class="form-control"  wire:keydown.enter="overrideFilter()">
                    </div>
                    <div class="col-lg-12 mb-2">

                        @forelse ($searchData as $key=>$value)    
                        <span class="badge badge-primary pl-2 pr-2 pt-1 pb-1 m-1">{{$value}} <button class="btn btn-sm btn-info fas fa-times pl-1 pr-1 pt-0 pb-0 m-0" wire:click="outSearchData('{{$value}}')"></button></span>
             
                        @empty
                            <p></p>
                        @endforelse
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-3">


                    <div class="input-group-prepend mb-3">
                        <select wire:model='selected_categoria' class="form-control">
                            <option value="null" disabled>Elegir Categoria</option>
                            @foreach ($categories as $key => $category)
                            <option value="{{ $category->id }}">{{ $category->name}}</option>
                            @endforeach
                   
                          </select>
                        <button class="boton-azul" wire:click= "resetCategorias()">
                            <i class="fas fa-redo-alt text-white"></i>
                        </button>
        
        
                    </div>


                </div>
                <div class="col-12 col-lg-3 col-md-3">
                    <div class="input-group-prepend mb-3">
                        <select wire:model='selected_sub' class="form-control">
                          <option value="null" disabled>Elegir Subcategoria</option>
                          @foreach ($sub as $subcategoria)
                          <option value="{{ $subcategoria->id }}">{{ $subcategoria->name}}</option>
                          @endforeach
                      
                        </select>
                        <button wire:click= "resetSubcategorias()" class="boton-azul">
                            <i class="fas fa-redo-alt text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-lg-2 col-md-3">
                    <div class="form-group">
                        <select wire:model='estados' class="form-control mt--2">
                          <option value="null" disabled>Estado</option>
                          <option value="ACTIVO">ACTIVO</option>
                          <option value="INACTIVO">INACTIVO</option>
                        </select>
                      </div>
                </div>
            </div>
            <div class="widget-content">
                <a href="javascript:void(0)" class="btn btn-info btn-sm mb-2" wire:click= 'deleteProducts()'>Eliminar Productos seleccionados</a>
                <div class="table-5">
                    <table>
                        <thead>
                            <tr class="text-center">
                                <th> <b>#</b> </th>
                                <th> Todos <b> <input type="checkbox" class="form-control" wire:model="checkAll"> </b> </th>
                                <th> <b>NOMBRE</b> </th>
                                <th> <b>CATEGORIA</b> </th>
                                <th> <b>CODIGO/<br>CODIGO BARRA</b></th>
                                <th> <b>PRECIO</b> </th>
                                <th> <b>STATUS</b> </th>
                                <th> <b>IMAGEN</b> </th>
                                <th> <b>ACCIONES</b> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $products)
                                <tr>
                                    <td>
                                        <h6>{{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}</h6>
                                    </td>
                                    <td>
                                        <input  type="checkbox" class="form-control" wire:model="selectedProduct" value="{{$products->id}}">
                                    </td>
                                    <td>
                                        <h5> <strong>{{$products->nombre}}</strong> </h5>
                                        <label><b>  Unidad: </b>{{$products->unidad ? $products->unidad : "No definido" }}</label> | <label> <b> Marca:</b>{{$products->marca ? $products->marca : "No definido" }} | </label><b> Industria:<label> </b>{{$products->industria ? $products->industria : "No definido" }}</label>
                                        <h6>{{ $products->caracteristicas }}</h6>

                                    </td>
                                    @if ($products->category->subcat == null)
                                    <td>
                                        <h6 class="text-center"> <strong>Categoria:</strong> {{ $products->category->name}}</h6>
                                        <h6 class="text-center"> <strong>Subcategoria:</strong>No definido</h6>
                                   </td>
                                    @else
                                    <td>
                                        <h6 class="text-center"> <strong>Categoria:</strong> {{ $products->category->subcat->name}}</h6>
                                        <h6 class="text-center"> <strong>Subcategoria:</strong>{{ $products->category->name}}</h6>
                                   </td>
                                    @endif
                                   
                                    <td>
                                         <h6 class="text-center">{{ $products->codigo}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center"> <strong>Costo:</strong> {{ $products->costo}}</h6>
                                        <h6 class="text-center"> <strong>Precio:</strong> {{ $products->precio_venta }}</h6>
                                    </td>
                                    @if ($products->status== 'ACTIVO')
                                    
                                    <td class="text-center"><span class="badge badge-success mb-0">{{$products->status}}</span></td>
                                    @else
                                    <td class="text-center"><span class="badge badge-danger mb-0">{{$products->status}}</span></td>
                                        
                                    @endif
                                    
                                    <td class="text-center">
                                        <span>
                                            <img src="{{ asset('storage/productos/' . $products->imagen) }}"
                                                alt="imagen de ejemplo" height="50" width="60" class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="Edit({{ $products->id }})"
                                            class="boton-azul" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0)"
                                            onclick="Confirm('{{ $products->id }}','{{ $products->nombre }}',{{$products->destinos->count()}})"
                                            class="boton-rojo" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
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
