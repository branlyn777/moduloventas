<style>
    .container {
        width: 13rem;
        height: 13rem;
        display: block;
        margin: 0 auto;
    }

    .outer {
        width: 100% !important;
        height: 100% !important;
        max-width: 18rem !important;
        /* any size */
        max-height: 18rem !important;
        /* any size */
        margin: auto;

        position: relative;
    }

    .outer img {
        width: 10rem;
        height: 10rem;
        margin: auto;
        position: absolute;
        bottom: 0;
        left: 0;
        top: 0;
        right: 0;
        z-index: 1;
        -webkit-mask-image: radial-gradient(circle 10rem at 50% 50%, black 75%, transparent 75%);
        border: 5px solid #d7d7d8;
        border-radius: 50%;
        padding: 3px;

    }

    .inner {
        background-color: #5e72e4;
        width: 45px;
        height: 45px;
        border-radius: 100%;
        position: absolute;
        bottom: 0;
        right: 0;
        -ms-transform: translate(-70%, -60%);
        transform: translate(-50%, -50%);
        z-index: 999999999;
    }

    .inner:hover {
        background-color: #69696d;
    }

    .inputfile {
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: 1;
        width: 50px;
        height: 50px;
    }

    .inputfile+label {
        font-size: 1.2rem;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        overflow: hidden;
        width: 50px;
        height: 50px;
        pointer-events: none;
        cursor: pointer;
        line-height: 43px;
        margin: 0px -2px;
        text-align: center;
    }

    .inputfile+label svg {
        fill: #fff;
    }
</style>

<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                @if ($selected_id != null)
                    <h5 class="modal-title text-white" id="exampleModalLabel">Editar Producto</h5>
                @else
                    <h5 class="modal-title text-white" id="exampleModalLabel">Registrar Producto</h5>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">


                    <div class="col-lg-12">
                        <div class="row">

                            <div class="container">
                                <div class="outer">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}">
                                    @else
                                        <img src="{{ asset('storage/productos/' . $imagen) }}">
                                    @endif
                                    <div class="inner">
                                        <input class="inputfile" type="file" wire:model='image' name="pic"
                                            accept="image/*">
                                        <label>
                                            <i class="fas fa-camera text-white text-center"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12 col-lg-7 col-md-8">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Nombre</label>
                            <div class="input-group-sm">

                                <input type="text" wire:model.lazy="nombre" class="form-control"
                                    placeholder="ej:Celular Samsung Galaxy A01">
                                @error('nombre')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-5 col-md-4">
                        <div class="form-group">
                            <label class="col-lg-3"><span class="text-warning">* </span>Código</label>
                            <div class="input-group input-group-sm" role="group" aria-label="Basic example">
                                <input type="text" wire:model.lazy="codigo" class="form-control"
                                    placeholder="ej: 20202225">
                                <button type="button" wire:click="GenerateCode()" class="btn btn-info m-0"
                                    title="Generar Codigo">
                                    <i class="fas fa-barcode"></i>
                                </button>
                            </div>
                            @error('codigo')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Características</label>

                            <div class="input-group-sm mb-3">
                                <input type="text" wire:model.lazy="caracteristicas" class="form-control"
                                    placeholder="ej: Producto nuevo">
                                @error('caracteristicas')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Garantía(en días)</label>
                            <div class="input-group-sm mb-3">

                                <input type="number" wire:model="garantia" class="form-control"
                                    placeholder="introducir dias">
                                @error('garantia')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Unidad de Medida</label>
                            <div class="input-group input-group-sm mb-3">
                                <select wire:model.lazy='unidad' class="form-control">
                                    <option value=null selected disabled>Elegir</option>
                                    @foreach ($unidades as $unidad)
                                        <option value="{{ $unidad->nombre }}" selected>{{ $unidad->nombre }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="btn btn-primary" title="Agregar Unidad"
                                    data-bs-toggle="modal" data-bs-target="#modalUnidad"> <i
                                        class="fas fa-plus text-white"></i>
                                </button>
                                @error('unidad')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Marca</label>
                            <div class="input-group input-group-sm mb-3">
                                <select wire:model.lazy='marca' class="form-control">
                                    <option value=null selected disabled>Elegir</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->nombre }}" selected>{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="btn btn-primary" title="Agregar Marca"
                                    data-bs-toggle="modal" data-bs-target="#modalMarca"> <i
                                        class="fas fa-plus text-white"></i> </button>
                                @error('marca')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Industria</label>
                            <div class="input-group-sm mb-3">
                                <input type="text" wire:model.lazy="industria" class="form-control"
                                    placeholder="ej: China">
                                @error('industria')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Costo</label>
                            <div class="input-group-sm mb-3">
                                <input type="number" min="1" wire:model.lazy="costo" class="form-control"
                                    placeholder="ej: 12">
                                @error('costo')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Precio de venta</label>
                            <div class="input-group-sm mb-3">
                                <input type="number" min="1" wire:model.lazy="precio_venta"
                                    class="form-control" placeholder="ej: 24">
                                @error('precio_venta')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-sm-12 col-lg-4 col-md-4">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Categoría</label>
                            <div class="input-group input-group-sm">
                                <select wire:model='selected_id2' class="form-control">
                                    <option value=null selected disabled>Elegir</option>
                                    @foreach ($categories as $Key => $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" title="Agregar categoria"
                                    data-bs-toggle="modal" data-bs-target="#modalCategory"> <i
                                        class="fas fa-plus text-white"></i>
                                </button>
                            </div>
                            @error('selected_id2')
                                <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        title="Agregar subcategoria" data-bs-target="#modalSubcategory"> <i
                                            class="fas fa-plus text-white"></i> </button>
                                @endif
                            </div>
                            @error('categoryid')
                                <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Cantidad Mínima</label>
                            <div class="input-group-sm mb-3">
                                <input type="number" min="1" wire:model.lazy="cantidad_minima"
                                    class="form-control" placeholder="ej: 5">
                                @error('cantidad_minima')
                                    <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
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
                                    @error('estado')
                                        <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
            <div class="modal-footer">

                {{-- <div class="input-group">
                    <div class="input-group mb-4">
                        <div class="card-body">
                            <button type="button" wire:click.prevent="Store()" class="btn btn-primary close-btn">
                                Guardar y Agregar Cantidad Inicial</button>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <button type="button" wire:click.prevent="resetUI()" class="btn btn-secondary close-btn"
                            data-bs-dismiss="modal">Cancelar</button><br>
                        @if ($selected_id < 1)
                            <button type="button" wire:click.prevent="Store()" class="btn btn-primary close-btn">
                                Guardar y Cerrar</button>
                        @else
                            <button type="button" wire:click.prevent="Update()"
                                class="btn btn-primary close-btn">Actualizar</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <button type="button" wire:click.prevent="Store()" class="btn btn-primary close-btn">
                        Guardar y Agregar Cantidad Inicial</button>
                </div>
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-secondary close-btn"
                    data-bs-dismiss="modal">Cancelar</button><br>
                @if ($selected_id < 1)
                    <button type="button" wire:click.prevent="Store()" class="btn btn-primary close-btn">
                        Guardar y Cerrar</button>
                @else
                    <button type="button" wire:click.prevent="Update()"
                        class="btn btn-primary close-btn">Actualizar</button>
                @endif --}}

                
                <div class="card-body">
                    <button type="button" wire:click.prevent="Store()" class="btn btn-primary close-btn">
                        Guardar y Agregar Cantidad Inicial</button>
                </div>
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-secondary close-btn"
                    data-bs-dismiss="modal">Cancelar</button><br>
                @if ($selected_id < 1)
                    <button type="button" wire:click.prevent="Store()" class="btn btn-primary close-btn">Guardar y
                        Cerrar</button>
                @else
                    <button type="button" wire:click.prevent="Update()"
                        class="btn btn-primary close-btn">Actualizar</button>
                @endif
            </div>
        </div>

    </div>
</div>
