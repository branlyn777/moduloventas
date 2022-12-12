<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                @if ($selected_id != null)
                    
                <h5 class="modal-title text-white" id="exampleModalLabel">Editar Producto</h5>
                @else
                <h5 class="modal-title text-white" id="exampleModalLabel">Registrar Producto</h5>
                    
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
           
                </button>
               
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-lg-7 col-md-8">
                        <div class="form-group">
                            <label>Nombre</label>
                            <div class="input-group-sm">

                                <input type="text" wire:model.lazy="nombre" class="form-control" 
                                    placeholder="ej:Celular Samsung Galaxy A01">
                                @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-5 col-md-4">
                        <div class="form-group">
                            <label class="col-lg-3">Codigo</label>

                            <div class="input-group input-group-sm mb-3">

                                <input type="text" wire:model.lazy="codigo" class="form-control"
                                    placeholder="ej: 20202225">
                                <button type="button" wire:click="GenerateCode()" class="btn btn-info m-0"
                                    title="Generar Codigo">
                                    <i class="fas fa-barcode"></i>
                                </button>
    
                                @error('codigo') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Caracteristicas</label>
                            
                            <div class="input-group-sm mb-3">
                                <input type="text" wire:model.lazy="caracteristicas" class="form-control"
                                    placeholder="ej: Producto nuevo">
                                @error('caracteristicas') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Garantia(en dias)</label>
                            <div class="input-group-sm mb-3">

                                <input type="number" wire:model="garantia" class="form-control"
                                    placeholder="introducir dias">
                                @error('garantia') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Numero de Lote</label>
                            <input type="text" wire:model.lazy="lote" class="form-control" placeholder="ej: L001">
                            @error('lote') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div> --}}
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Unidad de Medida</label>
                            <div class="input-group input-group-sm mb-3">
                                <select wire:model.lazy='unidad' class="form-control">
                                    <option value=null selected disabled>Elegir</option>
                                    @foreach($unidades as $unidad)
                                    <option value="{{ $unidad->nombre }}" selected>{{ $unidad->nombre }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="btn btn-primary" title="Agregar Unidad" data-bs-toggle="modal" data-bs-target="#modalUnidad"> <i
                                        class="fas fa-plus text-white"></i>
                                </button>
                                @error('unidad') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Marca</label>
                            <div class="input-group input-group-sm mb-3">
                                <select wire:model.lazy='marca' class="form-control">
                                    <option value=null selected disabled>Elegir</option>
                                    @foreach($marcas as $unidad)
                                    <option value="{{ $unidad->nombre }}" selected>{{ $unidad->nombre }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    title="Agregar Marca" data-bs-target="#modalMarca"> <i
                                        class="fas fa-plus text-white"></i> </button>
                            </div>
                            @error('marca') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Industria</label>
                            <div class="input-group-sm mb-3">
                            <input type="text" wire:model.lazy="industria" class="form-control"
                                placeholder="ej: China">
                            @error('industria') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Costo</label>
                            <div class="input-group-sm mb-3">
                            <input type="number" min="1" wire:model.lazy="costo" class="form-control"
                                placeholder="ej: 12">
                            @error('costo') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Precio de venta</label>
                            <div class="input-group-sm mb-3">
                            <input type="number" min="1" wire:model.lazy="precio_venta" class="form-control"
                                placeholder="ej: 24">
                            @error('precio_venta') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-4 col-md-4">
                        <div class="form-group">
                            <label>Categoría</label>
                            <div class="input-group input-group-sm mb-3">
                                <select wire:model='selected_id2' class="form-control">
                                    <option value=null selected disabled>Elegir</option>
                                    @foreach ($categories as $Key => $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    title="Agregar categoria" data-target="#modalCategory"> <i
                                        class="fas fa-plus text-white"></i> </button>
                            </div>
                            @error('selected_id2') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Subcategoría</label>
                            <div class="input-group input-group-sm mb-3">

                                <select wire:model='categoryid' class="form-control">
                                    <option value=null selected disabled>Elegir</option>
                                    @foreach ($subcat as $Key => $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if ($selected_id2 != null)

                                <a href="javascript:void(0)" class="btn btn-dark pl-2 pr-2" data-toggle="modal"
                                    title="Agregar subcategoria" data-target="#modalSubcategory"> <i
                                        class="fas fa-plus text-white"></i> </a>
                                @endif
                            </div>
                            @error('categoryid') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Cantidad Minima</label>
                            <div class="input-group-sm mb-3">
                            <input type="number" min="1" wire:model.lazy="cantidad_minima" class="form-control"
                                placeholder="ej: 5">
                            @error('cantidad_minima') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    @if ($selected_id)

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Estado</label>
                            <div class="input-group-sm mb-3">
                            <select wire:model='estado' class="form-control">
                                <option value="Elegir" disabled>Elegir</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                            @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    @endif

                    {{-- <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Control Lote</label>
                            <select wire:model='cont_lote' class="form-control">
                                <option value="null" disabled>Elegir</option>
                                <option value="MANUAL">Seleccion Manual</option>
                                <option value="AUTOMATICO">FIFO automatico</option>
                            </select>
                            @error('cont_lote') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div> --}}

                    <div class="col-sm-12 col-md-12">
                        <label> <b> Subir Imagen</b></label>
                        <div class="input-group-sm mb-3">
                        <div class="custom-file p-1">
                            <label class="custom-file p-0">
                                <input type="file" wire:model="image" id="im" class="form-control custom-file"
                                    style="padding-top:0.4rem" accept="image/x-png,image/gif,image/jpeg"
                                    class="custom-file-input" id="inputGroupFile03">
                            </label>
                            </div>
                            <div wire:loading wire:target="image" wire:key="image"><i
                                    class="fa fa-spinner fa-spin mt-2 ml-2"></i> Subiendo...</div>
                        </div>
                    </div>


                </div>
         
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-secondary close-btn"
                    data-dismiss="modal">Cancelar</button>
                @if ($selected_id < 1)
                    <button type="button" wire:click.prevent="Store()"
                        class="btn btn-warning close-btn">Guardar</button>
                @else
                    <button type="button" wire:click.prevent="Update()"
                        class="btn btn-warning close-btn">Actualizar</button>
                @endif
            
            
            </div>
        </div>
    
    </div>
</div>




















