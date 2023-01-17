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
        <h6 class="font-weight-bolder mb-0 text-white">Categoría Productos</h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('categoriaproductnav')
    "nav-link active"
@endsection


@section('Gestionproductosshow')
    "collapse show"
@endsection

@section('categoriaproductli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Categorías</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0" wire:click="resetUI()" data-bs-toggle="modal"  data-bs-target="#theModalCategory">
                            <i class="fas fa-plus"></i> Agregar Categoría</a>
                    </div>
                </div>

            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="padding-left: 12px; padding-right: 12px;">

                        <div class="row justify-content-between">
                            <div class="mt-lg-0 col-md-3">
                                <label style="font-size: 1rem">Buscar</label>
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        <input type="text" wire:model="search" placeholder="Nombre de Categoria"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="ms-auto my-auto mt-lg-0 col-md-2">
                                <div class="ms-auto my-auto">
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
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm ps-2">NOMBRE</th>
                                    <th class="text-uppercase text-sm ps-2">SUBCATEGORÍAS</th>
                                    {{-- <th class="text-uppercase text-sm">ESTADO</th> --}}
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="text-left">
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($categories->currentpage() - 1) * $categories->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ substr($category->name, 0, 30) }}<br>
                                            Descripción :
                                            {{ $category->descripcion == null ? 'S/N Descripcion' : substr($category->descripcion, 0, 45) }}

                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            <a href="javascript:void(0)" wire:click="Ver({{ $category->id }})"
                                                class="boton-azul mx-3" title="Ver subcategorias">
                                                <b class="pl-1 mx-3">{{ $category->subcategories() }}</b>
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>


                                        <td class="text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $category->id }})"
                                                class="mx-3" class="boton-azul" title="Editar Categoria">
                                                <i class="fas fa-edit" style="font-size: 14px"></i>
                                            </a>

                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $category->id }}','{{ $category->name }}','{{ $category->products->count() }}','{{ $category->subcategories() }}')"
                                                class="boton-rojo mx-3" title="Eliminar Categoria">
                                                <i class="fas fa-trash text-danger" style="font-size: 14px"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $categories->links() }}
        </div>
    </div>
    @include('livewire.category.form')
    @include('livewire.category.form_subcategory')
    @include('livewire.category.subcategories')
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', Msg => {
            $('#theModalCategory').modal('show')
        });
        window.livewire.on('hide_modal_sub', Msg => {
            $('#theModal_subcategory').modal('hide')
        });
        window.livewire.on('modal_sub', Msg => {
            $('#theModal_subcategory').modal('show')
        });
        window.livewire.on('item-added', Msg => {
            $('#theModalCategory').modal('hide');
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
        window.livewire.on('sub-show', Msg => {
            $('#theModal_subcategory').modal('hide')
            $('#theModal_s').modal('show')

        });
        window.livewire.on('sub_added', Msg => {
            $('#theModal_s').modal('hide');
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
        window.livewire.on('item-updated', Msg => {
            $('#theModalCategory').modal('hide')
            $('#theModal_s').modal('hide')
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
        window.livewire.on('item-deleted', Msg => {
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

    });

    function Confirm(id, name, products, subcategories) {
        if (products > 0 || subcategories > 0) {

            swal.fire({
                title: 'PRECAUCION',
                type: 'warning',
                text: 'No se puede eliminar la categoria ' + name +
                    ' porque tiene productos o categorias relacionadas.'
            })
            return;

        }
    else {

            swal.fire({
                title: 'CONFIRMAR',
                type: 'warning',
                text: 'Confirmar eliminar la categoria ' + '"' + name + '"',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                // cancelButtonColor: '#383838',
                // confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRow', id)
                    Swal.close()
                }
            })
        }
    }
</script>
