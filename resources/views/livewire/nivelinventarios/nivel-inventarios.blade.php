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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Nivel Inventarios</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Valuacion Inventarios</h6>
    </nav>
@endsection




@section('nivelinventariosnav')
    "nav-link active"
@endsection


@section('nivelinventariosli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Nivel de Inventarios</h5>
                </div>


            </div>

            <div class="card mb-4">
                <div class="card-body m-0">
                    <div class="padding-left: 12px; padding-right: 12px;">
                        <div class="row justify-content-start">

                            <div class="col-12 col-sm-6 col-md-4" style="margin-bottom: 7px;">
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

                            <div class="col-12 col-sm-6 col-md-4" style="margin-bottom: 7px;">
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
                            <div class="col-12 col-sm-6 col-md-4" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem">Sucursal</label>
                                <div class="input-group">
                                    <select wire:model='sucursal_id' class="form-select">
                                        @foreach ($sucursales as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                        <option value="Todos">Todas las Sucursales</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">

                        <table class="table align-items-between">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm text-left">


                                        Producto

                                    </th>
                                    <th class="text-uppercase text-sm text-center">Cant.</th>
                                    <th class="text-uppercase text-sm text-center">Costo Total</th>
                                    <th class="text-uppercase text-sm text-center">Acc.</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $products)
                                    <tr style="font-size: 14px" class="mt-2">
                                        <td class="text-center">
                                            {{ $loop->index + 1 }}
                                        </td>

                                        <td>

                                            <label><strong>{{ $products->nombre }}</strong>
                                            </label>

                                            <p class="text-xs">
                                                {{ $products->unidad }}|{{ $products->marca }}|{{ $products->industria }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            {{ number_format($products->total_existencia, 0) }}
                                        </td>
                                        <td class="text-center">
                                            {{ number_format($products->total_costo, 2) }}
                                        </td>

                                        <td class="text-sm align-middle text-center">
                                            <a href="{{ route('kardex-productos', $products->id) }}" type="button"
                                                class="btn btn-primary" class="mx-3" title="Ver Kardex">
                                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                                Ver Kardex
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>


                            <tfoot>

                                <tr>
                                    <td colspan="3" class="text-center">
                                        Total Inversion Bs.
                                    </td colspan="1">
                                    <td class="text-center">
                                        {{ number_format($data->sum('total_costo'), 2) }}
                                    </td>
                                </tr>
                            </tfoot>

                        </table>


                    </div>
                </div>

            </div>
        </div>
    </div>

</div>





@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            window.livewire.on('modal-locacion', msg => {
                $('#theModal').modal('show')
            });
            window.livewire.on('modal-hide', msg => {
                $('#theModal').modal('hide')
            });


        });
    </script>
@endsection
