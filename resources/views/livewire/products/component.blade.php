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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Inventarios</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Lista Productos </h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('listaproducnav')
    "nav-link active"
@endsection


@section('Gestionproductosshow')
    "collapse show"
@endsection

@section('listaproducli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Lista Productos</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a href="javascript:void(0)" class="btn btn-add mb-0" data-bs-toggle="modal"
                            wire:click='resetUI()' data-bs-target="#theModal">
                            <i class="fas fa-plus me-2"></i> Nuevo Producto
                        </a>
                        @can('Reportes_Inventarios_Export')
                            <button wire:click="$emit('modal-import')" type="button" class="btn btn-light mb-0">
                                {{-- <i class="fas fa-arrow-down"></i> --}} Importar
                            </button>
                            <a href='{{ url('productos/export/') }}' class="btn btn-success mb-0" type="button">
                                {{-- <i class="fas fa-arrow-alt-circle-up"></i> --}} Exportar
                            </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body m-0">
                    <div class="padding-left: 12px; padding-right: 12px;">
                        <div class="row justify-content-between">
                            <div class="mt-lg-0  col-md-3">
                                <label style="font-size: 1rem">Buscar</label>
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        <input type="text" wire:model="search"
                                            placeholder="nombre de producto, codigo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">

                                    @forelse ($searchData as $key=>$value)
                                        <span class="badge badge-primary pl-2 pr-2 pt-1 pb-1 m-1">{{ $value }}
                                            <button class="btn btn-sm btn-info fas fa-times pl-1 pr-1 pt-0 pb-0 m-0"
                                                wire:click="outSearchData('{{ $value }}')"></button></span>

                                    @empty
                                        <p></p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-2" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem">Filtrar por Estado</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" wire:change="cambioestado()" type="checkbox"
                                        role="switch" {{ $this->estados == true ? 'checked' : '' }}>
                                    @if ($estados)
                                        <label
                                            style="font-size: 16px;
                                        font-weight: 400;
                                        line-height: 1.7;
                                        margin:0px 0.9rem;
                                        align-self: left;
                                        color: #525f7f;">Activos</label>
                                    @else
                                        <label
                                            style="font-size: 16px;
                                        font-weight: 400;
                                        line-height: 1.7;
                                        margin:0px 0.9rem;
                                        align-self: left;
                                        color: #525f7f;">Inactivos</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem">Categoría</label>
                                <div class="input-group">
                                    <select wire:model='selected_categoria' class="form-select">
                                        <option value=null selected disabled>Elegir Categoría</option>
                                        @foreach ($categories as $key => $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        <option value='no_definido'>No definido</option>
                                    </select>
                                    <button class="btn btn-primary" wire:click="resetCategorias()">
                                        <i class="fa-sharp fa-solid fa-xmark"></i>
                                        {{-- <i class="fas fa-redo-alt text-white"></i> --}}
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem">Subcategorías</label>
                                <div class="input-group">
                                    <select wire:model='selected_sub' class="form-select">
                                        <option value="null" disabled>Elegir Subcategoría</option>
                                        @foreach ($sub as $subcategoria)
                                            <option value="{{ $subcategoria->id }}">{{ $subcategoria->name }}</option>
                                        @endforeach

                                    </select>
                                    <button wire:click="resetSubcategorias()" class="btn btn-primary">
                                        <i class="fa-sharp fa-solid fa-xmark"></i>
                                        {{-- <i class="fas fa-redo-alt text-white"></i> --}}
                                    </button>
                                    </tbody>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header pb-0">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <select wire:model="pagination" class="btn btn-primary dropdown-toggle">
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="500">500</option>
                            </select>
                        </div>
                        {{-- <button wire:click='deleteProducts()' type="button" class="btn btn-danger">Eliminar
                            Seleccionados</button> --}}
                        
                        {{-- @if ($selectedProduct) --}}
                            <button type="button" wire:click='EliminarSeleccion()' class="btn btn-danger">Eliminar
                                Seleccionados ({{count($selectedProduct)}})</button>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="" id="products-list">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-sm text-center">N°</th>
                                            <th class="text-uppercase text-sm text-center">
                                                <div class="d-flex justify-content-start">
                                                    <div class="form-check my-auto">
                                                        <input type="checkbox" class="form-check-input"
                                                            wire:model="checkAll">
                                                    </div>
                                                    Producto
                                                </div>
                                            </th>
                                            <th class="text-uppercase text-sm">Categoría</th>
                                            <th class="text-uppercase text-sm">Sub Categoría</th>
                                            <th class="text-uppercase text-sm">Código</th>
                                            <th class="text-uppercase text-sm text-center">Costo Activo</th>
                                            <th class="text-uppercase text-sm text-center">Precio Activo</th>
                                            <th class="text-uppercase text-sm">Estado</th>
                                            <th class="text-uppercase text-sm text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $products)
                                            <tr style="font-size: 14px">
                                                <td class="text-center">
                                                    {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                                </td>

                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check my-auto">
                                                            <input class="form-check-input" type="checkbox"
                                                                wire:model="selectedProduct"
                                                                value="{{ $products->id }}">
                                                        </div>
                                                        <img src="{{ asset('storage/productos/' . $products->imagen) }}"
                                                            alt="hoodie" width="50" height="50">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <label style="font-size: 14px">{{ $products->nombre }}</label>
                                                            
                                                            
                                                            {{ $products->caracteristicas }}


                                                            <p>{{ $products->unidad}}|{{ $products->marca}}|{{ $products->industria }}
                                                            {{ $products->caracteristicas }}</p>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                                @if ($products->category->subcat != null)
                                                    <td>
                                                        {{ $products->category->subcat->name }}
                                                    </td>
                                                    <td>
                                                        {{ $products->category->name }}
                                                    </td>
                                                @else
                                                    <td>
                                                        {{ $products->category->name }}
                                                    </td>
                                                    <td>
                                                        No definido

                                                    </td>
                                                @endif
                                                <td>
                                                    {{ $products->codigo }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $products->costoActivo() == null ? '--' : $products->costoActivo() }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $products->precioActivo() == null ? '--' : $products->precioActivo() }}
                                                </td>

                                                <td>

                                                    @if ($products->status == 'ACTIVO')
                                                        <span class="badge badge-sm bg-gradient-success">
                                                            ACTIVO
                                                        </span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-danger">
                                                            INACTIVO
                                                        </span>
                                                    @endif

                                                </td>
                                                <td class="text-sm align-middle text-center">
                                                    <a href="javascript:void(0)"
                                                        wire:click="Edit({{ $products->id }})" class="mx-3"
                                                        title="Editar">
                                                        <i class="fas fa-edit text-secondary"></i>
                                                    </a>
                                                    @if ($products->status == 'ACTIVO')
                                                        <a href="javascript:void(0)"
                                                            onclick="Confirm('{{ $products->id }}','{{ $products->nombre }}',{{ $products->destinos->count() }})"
                                                            title="Eliminar">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
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
    <div class="table-5">

        {{ $data->links() }}
    </div>
    @include('livewire.products.form')
    @include('livewire.products.importarproductos')
    @include('livewire.products.modalunidad')
    @include('livewire.products.modalmarca')
    @include('livewire.products.modalsubcategory')
    @include('livewire.products.modalcategory')

</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('product-added', Msg => {
                $('#theModal').modal('hide')
                $("#im").val('');
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    padding: '2em'
                });
                toast({
                    type: 'success',
                    title: 'Producto registrado.',
                    padding: '2em',
                })
            });
            window.livewire.on('modal-import', msg => {
                $('#modalimport').modal('show')
            });

            window.livewire.on('product-updated', Msg => {
                $('#theModal').modal('hide')
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    padding: '2em'
                });
                toast({
                    type: 'success',
                    title: @this.mensaje_toast,
                    padding: '2em',
                })
            });

            window.livewire.on('product-deleted', Msg => {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    padding: '2em'
                });
                toast({
                    type: 'success',
                    title: @this.mensaje_toast,
                    padding: '2em',
                })
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
                    'El producto ' + @this.productError +
                    ' tiene relacion con otros registros del sistema.',
                    'error'
                )
            });
            window.livewire.on('sin-archivo', Msg => {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    padding: '2em'
                });
                toast({
                    type: 'info',
                    title: 'No ha seleccionado un archivo',
                    padding: '2em',
                })
            });
        });

        // Eliminar producto seleccionado              https://www.youtube.com/watch?v=MlE6NSmM5KE
        window.addEventListener('swal:EliminarSelect', function() {
            swal({
                title: 'PRECAUCION',
                text: "Este producto no tiene relacion con ningun registro del sistema, pasara a ser eliminado permanentemente.",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('EliminarSeleccionados', event.detail.checkedIDs)
                }
            })
        })

        function Confirm(id, name, products) {
            if (products > 0) {
                console.log(products);
                swal.fire({
                    title: 'PRECAUCION',
                    type: 'warning',
                    text: 'El producto' + name +
                        ' tiene relacion con otros registros del sistema, pasara a ser inactivado!',
                    showCancelButton: true,
                    cancelButtonText: 'Cerrar',
                    confirmButtonText: 'Aceptar'
                }).then(function(result) {
                    if (result.value) {
                        window.livewire.emit('deleteRow', id)
                        Swal.close()
                    }
                })
                //este producto tiene varias relaciones activas con otros registros del sistema
            } else {
                swal.fire({
                    title: 'CONFIRMAR',
                    type: 'warning',
                    text: 'Este producto no tiene relacion con ningun registro del sistema, pasara a ser eliminado permanentemente. ',
                    showCancelButton: true,
                    cancelButtonText: 'Cerrar',
                    // cancelButtonColor: '#383838',
                    // confirmButtonColor: '#3B3F5C',
                    confirmButtonText: 'Aceptar'
                }).then(function(result) {
                    if (result.value) {
                        window.livewire.emit('deleteRowPermanently', id).Swal.close()
                    }
                })
            }
        }
    </script>

    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection
