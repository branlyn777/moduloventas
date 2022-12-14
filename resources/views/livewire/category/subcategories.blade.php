<div wire:ignore.self class="modal fade" id="theModal_subcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary text-white" style="background: #f8f6f6">
                <b>Lista de Subcategorias</b> 
                <a href="javascript:void(0)" wire:click="asignarCategoria('{{$selected_id}}')"
                    class="btn btn-secondary p-1" data-dismiss="modal" style="color: #fff">Agregar Subcategorias</i></a>
            </div>
            <div class="modal-body">

                {{-- @if ($subcat->isNotEmpty()) --}}
                
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-container">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-center" style="font-size: 12px">
                                                <th  style="width: 5%">#</th>
                                                <th>Nombre</th>
                                                <th style="width: 20%">Descripcion</th>
                                                <th> Acc.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($subcat as $category)
                                                <tr class="text-center">
                                                    <td>
                                                        <h6 style="font-size: 13px">{{ $loop->index+1 }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6 style="font-size: 13px">{{ $category->name }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6 style="font-size: 13px"> {{$category->descripcion ==null?'S/N Descripcion':$category->descripcion}}</h6>
                                                    </td>
                                                    
                                                    <td>
                                                        {{-- <button href="javascript:void(0)" wire:click="Edit({{ $category->id }})"
                                                            class="btn btn-dark p-1" title="Editar Subcategoria">
                                                            <i class="fas fa-edit"></i>
                                                        </button> --}}

                                                        <a href="javascript:void(0)" wire:click="Edit({{ $category->id }})" class="mx-3"
                                                            class="boton-azul" title="Editar Subcategoria">
                                                            <i class="fas fa-edit" style="font-size: 13px"></i>
                                                        </a>
                                                    
                                                        <a href="javascript:void(0)" onclick="Confirm('{{ $category->id }}','{{ $category->name }}','{{ $category->products->count() }}')"
                                                            class="boton-rojo mx-3" title="Eliminar subcategoria">
                                                            <i class="fas fa-trash text-danger" style="font-size: 13px"></i>
                                                        </a>
                                                        
                                                        {{-- <button href="javascript:void(0)" onclick="Confirm('{{ $category->id }}','{{ $category->name }}',
                                                            '{{ $category->products->count() }}')" class="btn btn-danger p-1"
                                                             title="Eliminar subcategoria">
                                                            <i class="fas fa-trash"></i>
                                                        </button> --}}
                                                    </td>
                                                </tr>
                                                @empty 
                                                <p>No tiene categorias que  mostrar</p>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                {{-- @else --}}
                    {{-- <div class="tabs tab-pills text-center">
                        <button type="button" class="boton-azul-g" wire:click="asignarCategoria('{{$selected_id}}')"
                            data-dismiss="modal" style="background: #3b3f5c">
                            <i class="fas fa-plus-circle"></i>  Agregar Subcategorias </button>
                    </div> --}}
                {{-- @endif --}}
                {{-- <div class="tabs tab-pills text-right">
                    <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning m-2"
                        data-dismiss="modal" style="background: #3b3f5c">Cerrar</button>
                </div> --}}
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>