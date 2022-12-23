@section('migaspan')
      <nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
				<li class="breadcrumb-item text-sm">
					<a class="text-white" href="javascript:;">
						<i class="ni ni-box-2"></i>
					</a>
				</li>
				<li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
						href="{{url("")}}">Inicio</a></li>
				<li class="breadcrumb-item text-sm text-white active" aria-current="page">Inventarios</li>
			</ol>
			<h6 class="font-weight-bolder mb-0 text-white">Categoria Productos</h6>
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
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">

                        <div>
                            <h5 class="mb-0" style="font-size: 16px">Categorias</h5>
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="javascript:void(0)" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#theModal" wire:click="resetUI()">
                                  Agregar Categoria
                                </a>

                                {{-- <button class="boton-azul-g" data-toggle="modal" data-target="#theModal" wire:click="resetUI()"> 
                                    <i class="fas fa-plus-circle"></i> Agregar Categoria</button> --}}
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="d-lg-flex">
                        <div class="col-12 col-sm-12 col-md-3">
                            @include('common.searchbox')
                        </div>
                
                        {{-- <div class="col-12 col-sm-12 col-md-3 text-center"> </div>--}}
                        <div class="ms-auto my-auto mt-lg-0 mt-4 col-md-2">
                            <div class="ms-auto my-auto">
                                <select wire:model='estados' class="form-control">
                                    <option value="null" disabled>Estado</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                    <option value="TODOS">TODOS</option>
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
                                        <tr class="text-center" style="font-size: 10.4px">
                                            <th>#</th>
                                            <th style="text-align: left">NOMBRE</th>
                                            <th>SUBCATEGORIAS</th>
                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr class="text-center" style="font-size: 12px">
                                                <td>
                                                    {{ ($categories->currentpage()-1) * $categories->perpage() + $loop->index + 1 }}
                                                </td>
                                                <td style="text-align: left">
                                                    {{-- <div class="row">
                                                        <div class="col-md-5"> --}}
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h5 style="font-size: 14px"><b>{{ $category->name }}</b></h5>
                                                                    <label  style="font-size: 12px"> Descripcion : {{$category->descripcion ==null?'S/N Descripcion':$category->descripcion}}</label>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="row">
                                                                <div class="col">
                                                                </div>
                                                            </div> --}}
                                                        {{-- </div>
                                                    </div> --}}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" wire:click="Ver({{$category->id}})"
                                                        class="boton-azul" title="Ver subcategorias"> <b class="pl-1">{{ $category->subcategories()}}</b> 
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            
                                                    @if ($category->status== 'ACTIVO')
                                                        
                                                        <td>
                                                            {{-- <span class="badge badge-success mb-0">{{$category->status}}</span> --}}
                                                            <span class="badge badge-sm bg-gradient-success">{{$category->status}}</span>
                                                        </td>
                                                    
                                                    @else
                                                        <td>
                                                            <span class="badge badge-sm bg-gradient-danger">{{$category->status}}</span>
                                                            {{-- <span class="badge badge-danger mb-0">{{$category->status}}</span> --}}
                                                        </td>
                                                    @endif
                                            
                                            
                                                <td>
                                                    <a href="javascript:void(0)" wire:click="Edit({{ $category->id }})" class="mx-3"
                                                        class="boton-azul" title="Editar Categoria">
                                                        <i class="fas fa-edit" style="font-size: 14px"></i>
                                                    </a>

                                                    {{-- <a href="javascript:void(0)" class="boton-azul mx-3" wire:click="asignarCategoria('{{$category->id}}')"
                                                        title="Agregar subcategorias">
                                                        <i class="fas fa-plus"></i>
                                                    </a> --}}

                                                    <a href="javascript:void(0)" onclick="Confirm('{{ $category->id }}','{{ $category->name }}','{{$category->products->count()}}','{{$category->subcategories()}}')"
                                                        class="boton-rojo mx-3" title="Eliminar categoria">
                                                        <i class="fas fa-trash text-danger"  style="font-size: 14px"></i>
                                                    </a>

                                                    {{-- <a href="javascript:void(0)" onclick="Confirm('{{ $category->id }}','{{ $category->name }}','{{$category->products->count()}}','{{$category->subcategories()}}')"
                                                        class="boton-celeste mx-3" title="Cambiar Estado">
                                                        <i class="fas fa-times-circle"  style="font-size: 14px"></i>
                                                    </a> --}}
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $categories->links()}}
            </div>
        </div>
    </div>
    @include('livewire.category.form')
    @include('livewire.category.form_subcategory')
    @include('livewire.category.subcategories')
  
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('hide_modal_sub', Msg => {
            $('#theModal_subcategory').modal('hide')
        });
        window.livewire.on('modal_sub', Msg => {
            $('#theModal_subcategory').modal('show')
        });
        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide');
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
            
        });
        window.livewire.on('sub-show', Msg => {
            $('#theModal_s').modal('show')
          
        });
        window.livewire.on('sub_added', Msg => {
            $('#theModal_s').modal('hide');
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
            
        });
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
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
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
       
    });
    function Confirm(id, name,products,subcategories) {
        if (products > 0 && subcategories>0) {

            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la categoria '+name+ ' porque tiene productos y categorias relacionadas.'
            })
            return;
         
        }
        if (products > 0) {
           
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la categoria ' + name + ' porque tiene productos relacionados.'
            
        })
    }
        if (subcategories > 0) {

            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la categoria ' + name + ' porque tiene subcategorias relacionadas.'
            })
        }
        else{

            swal.fire({
                title: 'CONFIRMAR',
                icon: 'warning',
                text: 'Confirmar eliminar la categoria ' + '"' + name + '"',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#383838',
                confirmButtonColor: '#3B3F5C',
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