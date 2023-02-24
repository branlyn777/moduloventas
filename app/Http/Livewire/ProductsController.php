<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ExportExcelProductosController;
use App\Imports\ProductsImport;
use App\Imports\PruebaImport;
use App\Models\Category;
use App\Models\Destino;
use App\Models\DetalleEntradaProductos;
use App\Models\IngresoProductos;
use App\Models\Lote;
use App\Models\Marca;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\Unidad;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $nombre, $costo, $precio_venta, $cantidad_minima, $name, $descripcion,$deno,
        $codigo, $lote, $unidad, $industria, $caracteristicas, $status, $categoryid = null, $search, $estado, $stockswitch,
        $image, $imagen, $selected_id, $pageTitle, $componentName, $cate, $marca, $garantia, $stock, $stock_v, $selected_categoria, $selected_sub, $nro = 1, $sub, $change = [], $estados, $searchData = [], $data2, $archivo, $failures, $productError,
        $cantidad, $costoUnitario, $costoTotal, $destinosp, $destino, $precioVenta;
    public $checkAll = false;
    public $errormessage;
    public $selectedProduct = [];
    public $newunidad, $newmarca, $subcategory;
    public $des_subcategory;
    //Variable para configurar el seguimiento de los lotes, de acuerdo a si quiere que sea manual la eleccion del lote o si quiere que sea por defecto automatico FIFO
    public $cont_lote;
    public $pagination = 25;
    public $selected_id2;
    public $mensaje_toast;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {


        $this->estados = 'Activo';

        $this->selected_categoria = null;
        $this->selectedProduct = collect();
        $this->marca = null;
        $this->unidad = null;
        $this->cont_lote = null;
        $this->imagen = 'noimagenproduct.png';
        $this->stockswitch = false;
        $this->cantidad = 1;

    }


    public function updatedSelectedCategoria()
    {
        $this->selected_sub = null;
    }

    /**
     * Restablece las variables selected_sub, selected_categoria, search y searchData a nulo.
     */
    public function resetCategorias()
    {
        $this->selected_sub = null;
        $this->selected_categoria = null;
        $this->search = null;
        $this->searchData = [];
    }
    public function resetSubcategorias()
    {
        $this->selected_sub = null;
    }



    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function updatingSelected_sub()
    {
        $this->resetPage();
        $this->searchData = [];
    }

    public function updatedSelectedId2()
    {

        $this->categoryid = null;
    }

    public function render()
    {

        $this->sub = Category::where('categories.categoria_padre', $this->selected_categoria)
            ->get();

        $prod = Product::join('categories as c', 'products.category_id', 'c.id')
            ->select('products.*')
            ->where('products.status', $this->estados == true ? 'ACTIVO' : 'INACTIVO')
            ->when($this->search != null and empty($this->searchData), function ($query) {
                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%')
                    ->orWhere('products.marca', 'like', '%' . $this->search . '%')
                    ->orWhere('products.caracteristicas', 'like', '%' . $this->search . '%');
            })

            ->when($this->search != null and !empty($this->searchData), function ($query) {
           
                $deno=$query;
            
                    foreach ($this->searchData as $data) {
                    
                        $deno= $deno->where(function($ques) use($data){
                            $ques->where('products.nombre', 'like', '%' . $data . '%')
                            ->orWhere('products.codigo', 'like', '%' . $data . '%')
                            ->orWhere('products.marca', 'like', '%' . $data . '%')
                            ->orWhere('products.caracteristicas', 'like', '%' . $data . '%');
                        });
                    
                 
                    }
    
                    $caramelo=$deno->where(function($bus){
                     
                        $bus->where('products.nombre', 'like', '%' . $this->search . '%')
                            ->orWhere('products.codigo', 'like', '%' . $this->search . '%')
                            ->orWhere('products.marca', 'like', '%' . $this->search . '%')
                            ->orWhere('products.caracteristicas', 'like', '%' . $this->search . '%');
                            return $bus;
                    });
    
     
                })
            

            ->when($this->selected_categoria != null and $this->selected_sub == null, function ($query) {
                $query->where('c.id', $this->selected_categoria)
                    ->where('c.categoria_padre', 0);
            })
            ->when($this->selected_sub != null, function ($query) {
                $query->where('c.id', $this->selected_sub)
                    ->where('categoria_padre', '!=', 0);
            })

            ->orderBy('products.created_at', 'desc');




        $ss = Category::select('categories.*')
            ->get();

        // if (count($this->searchData) > 0) {

        //     foreach ($this->searchData as $data) {
        //         $this->data2 = $data;
        //         $prod = $prod->where(function ($querys) {
        //             $querys->where('products.nombre', 'like', '%' . $this->data2 . '%')
        //                 ->orWhere('products.codigo', 'like', '%' . $this->data2 . '%')
        //                 ->orWhere('products.marca', 'like', '%' . $this->data2 . '%')
        //                 ->orWhere('products.caracteristicas', 'like', '%' . $this->data2 . '%');


        //         })->orderBy('products.created_at', 'desc');
        //     }
        // }

        $this->destinosp = Destino::join('sucursals as suc', 'suc.id', 'destinos.sucursal_id')
            ->select('suc.name as sucursal', 'destinos.nombre as destino', 'destinos.id as destino_id')
            ->get();




        return view('livewire.products.component', [
            'data' => $prod->paginate($this->pagination),
            'categories' => Category::where('categories.categoria_padre', 0)->orderBy('name', 'asc')->get(),
            'unidades' => Unidad::orderBy('nombre', 'asc')->get(),
            'marcas' => Marca::select('nombre')->orderBy('nombre', 'asc')->get(),
            'subcat' => $ss
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function Store()
    {

        if ($this->categoryid === null) {
            $this->categoryid = $this->selected_id2;
        }
        $rules = [
            'nombre' => 'required|unique:products|min:5',
            'nombre' => 'required|unique:products|max:245',
            'codigo' => 'required|unique:products|min:3',

            'selected_id2' => 'required|not_in:Elegir'
        ];

        $messages = [
            'nombre.required' => 'Nombre del producto requerido',
            'nombre.unique' => 'Ya existe el nombre del producto',
            'nombre.min' => 'El nombre debe  contener al menos 5 caracteres',
            'nombre.max' => 'El nombre no debe  tener mas de 245 caracteres',
            // 'costo.required' => 'El costo es requerido',
            'codigo.required' => 'El codigo es requerido',
            'codigo.unique' => 'El codigo debe ser unico',
            'codigo.min' => 'El codigo debe ser mayor a 3',
            'codigo.max' => 'El codigo no debe tener mas de ser 45 caracteres',
            // 'precio_venta.required' => 'El precio es requerido',
            'precio_venta.gt' => 'El precio debe ser mayor o igual al costo',
            'selected_id2.required' => 'La categoria es requerida',
            'selected_id2.not_in' => 'Elegir un nombre de categoria diferente de Elegir'
        ];

        $this->validate($rules, $messages);
        if ($this->stockswitch === true) {

            $rules = [

                'cantidad' => 'required|numeric|min:1',
                'costoUnitario' => 'required',
                'destino' => 'required',


            ];

            $messages = [
                'cantidad.required' => 'Agregue una cantidad',
                'cantidad.min' => 'Agregue una cantidad mayor a 0',
                'costoUnitario.required' => 'Agregue un costo para el ingreso inicial.',
                'destino.required' => 'Seleccione un destino.',

            ];
            $this->validate($rules, $messages);
        }
        DB::beginTransaction();
        try {

            $product = Product::create([
                'nombre' => $this->nombre,
                'caracteristicas' => $this->caracteristicas,
                'codigo' => $this->codigo,
                'lote' => $this->lote,
                'unidad' => $this->unidad,
                'marca' => $this->marca,
                'garantia' => $this->garantia,
                'cantidad_minima' => $this->cantidad_minima,
                'industria' => $this->industria,
                'category_id' => $this->categoryid,
                'control' => $this->cont_lote
            ]);
            if ($this->image) {
                $customFileName = uniqid() . '_.' . $this->image->extension();


                $this->image->storeAs('public/productos/', $customFileName);
                $product->image = $customFileName;
                $product->save();
            }


            if ($this->stockswitch === true) {
                $rs = IngresoProductos::create([
                    'destino' => $this->destino,
                    'user_id' => Auth()->user()->id,
                    'concepto' => 'INICIAL',
                    'observacion' => 'INVENTARIO INICIAL DE PRODUCTOS'
                ]);

                $lot = Lote::create([
                    'existencia' => $this->cantidad,
                    'costo' => $this->costoUnitario,
                    'status' => 'Activo',
                    'product_id' => $product->id,
                    'pv_lote' => $this->precioVenta
                ]);

                DetalleEntradaProductos::create([
                    'product_id' => $product->id,
                    'cantidad' => $this->cantidad,
                    'costo' => $this->costoUnitario,
                    'id_entrada' => $rs->id,
                    'lote_id' => $lot->id
                ]);

                $q = ProductosDestino::where('product_id', $product->id)
                    ->where('destino_id', $this->destino)->value('stock');

                ProductosDestino::updateOrCreate(['product_id' => $product->id, 'destino_id' => $this->destino], ['stock' => $q + $this->cantidad]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }


        $this->emit('product-added', 'Producto Registrado');
        $this->resetUI();
    }
    public function Edit(Product $product)
    {
        if ($product->category->categoria_padre === 0) {
            $this->selected_id2 = $product->category_id;
            $this->categoryid = null;
        } else {
            $this->selected_id2 = $product->category->categoria_padre;
            $this->categoryid = $product->category_id;
        }
        $this->selected_id = $product->id;
        $this->costo = $product->costo;
        $this->nombre = $product->nombre;
        $this->precio_venta = $product->precio_venta;
        $this->caracteristicas = $product->caracteristicas;
        $this->lote = $product->lote;
        $this->unidad = $product->unidad;
        $this->marca = $product->marca;
        $this->garantia = $product->garantia;
        $this->industria = $product->industria;
        $this->cantidad_minima = $product->cantidad_minima;
        $this->codigo = $product->codigo;
        $this->estado = $product->status;
        $this->imagen = $product->image == null ? 'noimagenproduct.png' : $product->image;
        $this->marca = $product->marca;
        $this->unidad = $product->unidad;
        $this->cont_lote = $product->control;
        $this->emit('modal-show');
    }
    public function Update()
    {
        if ($this->categoryid === null) {
            $this->categoryid = $this->selected_id2;
        }

        $rules = [
            'nombre' => "required|min:2|unique:products,nombre,{$this->selected_id}",
            'nombre' => "required|max:245|unique:products,nombre,{$this->selected_id}",
            'codigo' => "required|min:3|unique:products,codigo,{$this->selected_id}",
            'codigo' => "required|max:45|unique:products,codigo,{$this->selected_id}",
            // 'costo' => 'required|numeric',
            // 'precio_venta' => 'required|numeric',
            'categoryid' => 'required|not_in:Elegir',

        ];
        $messages = [
            'nombre.required' => 'Nombre del producto requerido',
            'nombre.unique' => 'Ya existe el nombre del producto',
            'nombre.min' => 'El nombre debe  contener al menos 2 caracteres',
            'nombre.max' => 'El nombre no debe  pasar los 245 caracteres',
            'codigo.min' => 'El código debe  contener al menos 3 caracteres',
            'codigo.max' => 'El código no debe pasar los 45 caracteres',
            'costo.required' => 'El costo es requerido',
            'precio_venta.required' => 'El precio es requerido',
            'costo.numeric' => 'El costo tiene que ser un numero',
            // 'cantidad_minima.numeric' => 'La cantidad minima solamente puede ser numerico',
            'precio_venta.numeric' => 'El precio de venta tiene que ser un numero',
            'categoryid.required' => 'La categoria es requerida',
            'categoryid.not_in' => 'Elegir un nombre de categoria diferente de Elegir'
        ];
        $this->validate($rules, $messages);
        $product = Product::find($this->selected_id);
        $product->update([
            'nombre' => $this->nombre,
            'costo' => $this->costo,
            'caracteristicas' => $this->caracteristicas,
            'codigo' => $this->codigo,
            'lote' => $this->lote,
            'unidad' => $this->unidad,
            'marca' => $this->marca,
            'garantia' => $this->garantia,
            'cantidad_minima' => $this->cantidad_minima,
            'industria' => $this->industria,
            'precio_venta' => $this->precio_venta,
            'category_id' => $this->categoryid,
            'status' => $this->estado,
            'control' => $this->cont_lote
        ]);
        if ($this->image) {
            //dd($this->image);
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/productos/', $customFileName);
            // dd("sd");
            $imageTemp = $product->image;
            $product->image = $customFileName;
            $product->save();

            if ($imageTemp != null) {
                if (file_exists('storage/productos/' . $imageTemp)) {
                    unlink('storage/productos/' . $imageTemp);
                }
            }
        }
        $this->resetUI();
        $this->mensaje_toast = 'Producto Actualizado';
        $this->emit('product-updated', 'Producto Actualizado');
    }
    protected $listeners = ['deleteRow' => 'Destroy', 'deleteRowPermanently' => 'DestroyPermanently', 'EliminarSeleccionados'];

    /**
     * Elimina el producto y su imagen de la base de datos y la carpeta de almacenamiento.
     * 
     * @param Product product El producto a eliminar
     */
    public function Destroy(Product $product)
    {
        $product->update([
            'status' => 'INACTIVO'
        ]);


        $this->resetUI();
        $this->mensaje_toast = 'Producto Eliminado';
        $this->emit('product-deleted', 'Producto Eliminado');
    }

    public function DestroyPermanently(Product $product)
    {
        $imageTemp = $product->image;
        $product->forceDelete();

        if ($imageTemp != null) {
            if (file_exists('storage/productos/' . $imageTemp)) {
                unlink('storage/productos/' . $imageTemp);
            }
        }
        $this->resetUI();
        $this->mensaje_toast = 'Producto Eliminado';
        $this->emit('product-deleted', 'Producto Eliminado');
    }

    public function resetUI()
    {
        $this->selected_id = null;
        $this->selected_id2 = null;
        $this->costo = '';
        $this->nombre = '';
        $this->precio_venta = '';
        $this->caracteristicas = '';
        $this->codigo = '';
        $this->estado = 'Elegir';
        $this->lote = '';
        $this->unidad = 'Elegir';
        $this->marca = 'Elegir';
        $this->industria = '';
        $this->garantia = null;
        $this->cantidad_minima = null;
        $this->categoryid = null;
        $this->image = null;
        $this->imagen = 'noimagenproduct.png';
        $this->marca = null;
        $this->unidad = null;
        $this->cont_lote = null;
        $this->stockswitch = false;
        $this->costoTotal = 0;
        $this->costoUnitario = 0;
        $this->cantidad = 1;
        $this->destino = null;
        $this->precioVenta = 0;


        $this->resetValidation(); //clear the error bag

    }

    public function overrideFilter()
    {
        array_push($this->searchData, $this->search);
        $this->search = null;
    }

    public function outSearchData($value)
    {

        $this->searchData = array_diff($this->searchData, array($value));
    }

    public function GenerateCode()
    {

        $min = 10000;
        $max = 99999;
        $this->codigo = Carbon::now()->format('ymd') . mt_rand($min, $max);
    }

    /**
     * Valida el formulario, crea una nueva categoría, la guarda, restablece el formulario, emite un
     * mensaje.
     */
    public function StoreCategory()
    {

        $rules = [
            'name' => 'required|unique:categories|min:3',
            'name' => 'required|unique:categories|max:245',
        ];
        $messages = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.unique' => 'Ya existe el nombre de la categoría',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'name.max' => 'El nombre de la categoría no debe pasar los 245 caracteres'
        ];
        $this->validate($rules, $messages);
        $category = Category::create([
            /* Convirtiendo el nombre a mayúsculas. */
            'name' =>  strtoupper($this->name),
            'descripcion' => $this->descripcion,
            'categoria_padre' => 0
        ]);

        $category->save();
        $this->resetCategory();

        $this->selected_id2 = $category->id;
    }

    public function resetCategory()
    {
        $this->reset('name', 'descripcion');
        $this->emit('cat-added', 'Categoría Registrada');
        $this->emit('product-form');
    }

    /**
     * Valida la entrada, crea un nuevo objeto Marca, lo guarda en la base de datos y luego reinicia la
     * entrada y emite un evento
     */
    public function StoreMarca()
    {
        $rules = ['newmarca' => 'required|unique:marcas,nombre|min:3'];
        $messages = [
            'newmarca.required' => 'El nombre de la marca es requerido',
            'newmarca.unique' => 'Ya existe el nombre de la marca',
            'newmarca.min' => 'El nombre de la marca debe tener al menos 3 caracteres'
        ];
        $this->validate($rules, $messages);
        $marca = Marca::create([
            'nombre' =>  strtoupper($this->newmarca)
        ]);

        $marca->save();
        $this->resetMarca();
        $this->marca = $marca->nombre;
    }

    public function resetMarca()
    {
        $this->reset('newmarca');
        $this->emit('marca-added');
        $this->emit('product-form');
    }


    /**
     * Valida la entrada, crea una nueva unidad, la guarda y luego reinicia la entrada y emite un evento.
     */
    public function StoreUnidad()
    {
        $rules = ['newunidad' => 'required|unique:unidads,nombre|min:3'];
        $messages = [
            'newunidad.required' => 'El nombre de la unidad es requerido',
            'newunidad.unique' => 'Ya existe el nombre de la unidad',
            'newunidad.min' => 'El nombre de la unidad debe tener al menos 3 caracteres'
        ];
        $this->validate($rules, $messages);
        $unidad = Unidad::create([
            'nombre' =>  strtoupper($this->newunidad)
        ]);

        $unidad->save();
        $this->resetUnidad();
        $this->unidad = $unidad->nombre;
    }
    public function resetUnidad()
    {
        $this->reset('newunidad');
        $this->emit('unidad-added');
        $this->emit('product-form');
    }

    /**
     * Crea una nueva categoría y luego emite un evento al componente principal
     */
    public function StoreSubcategory()
    {

        $rules = ['subcategory' => 'required|unique:categories,name|min:3'];
        $messages = [
            'subcategory.required' => 'El nombre de la subcategoría es requerido',
            'subcategory.unique' => 'Ya existe el nombre de la subcategoría',
            'subcategory.min' => 'El nombre de la subcategoría debe tener al menos 3 caracteres'
        ];
        $this->validate($rules, $messages);

        $category = Category::create([
            'name' =>  strtoupper($this->subcategory),
            'descripcion' => $this->descripcion,
            'categoria_padre' => $this->selected_id2
        ]);

        $category->save();
        $this->resetSubCat();
        $this->categoryid = $category->id;
    }

    public function resetSubCat()
    {
        $this->reset('des_subcategory', 'subcategory');
        $this->emit('subcat-added');
    }





    /**
     * Estoy tratando de importar un archivo con la función Excel::import().
     * 
     * @param archivo El archivo a importar.
     * 
     * @return El método de importación devuelve una colección de las filas importadas.
     */

    public function import()
    {
        try {
            try {
                Excel::import(new ProductsImport, $this->archivo);
                return redirect()->route('productos');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $this->failures = $e->failures();
            }
        } catch (Exception $e) {

            $this->emit('sin-archivo');
        }
    }
    /**
     * Si la casilla de verificación está marcada, la matriz de productos seleccionados se completará con
     * todos los ID de productos. Si la casilla de verificación no está marcada, la matriz de productos
     * seleccionados se vaciará.
     * 
     * @param value El valor de la casilla de verificación.
     */

    public function updatedCheckAll($value)
    {

        if ($value) {
            $this->selectedProduct = Product::pluck('id');
        } else {
            $this->selectedProduct = [];
        }
    }

    /**
     * Elimina un producto de la base de datos, pero primero verifica si el producto se está utilizando
     * en otras tablas. Si es así, emite un evento a la interfaz.
     */
    // public function deleteProducts()
    // {

    //     $auxi = 0;
    //     foreach ($this->selectedProduct as $data) {

    //         $product = Product::find($data);
    //         $product->destinos->count() > 0 ? $auxi++ : '';
    //         $product->detalleCompra->count() > 0 ? $auxi++ : '';
    //         $product->detalleSalida->count() > 0 ? $auxi++ :  '';
    //         $product->detalleTransferencia->count() > 0 ? $auxi++ :  '';
    //         $this->productError = $product->nombre;
    //         $this->mensaje_toast = 'Acccion realizada con exito';
    //         $this->emit('product-deleted');
    //     }

    //     if ($auxi != 0) {
    //         $this->emit('restriccionProducto');
    //     } else {
    //         Product::whereIn('id', $this->selectedProduct)->delete();
    //         $this->selectedProduct = [];
    //         $this->checkAll = false;
    //     }
    // }

    // Opcion de eliminar multiples datos
    public function EliminarSeleccion()
    {
        // dd($this->selectedProduct);
        // emite alert de confirmacion
        $this->dispatchBrowserEvent(
            'swal:EliminarSelect',
            [
                'title' => 'PRECAUCION',
                'id' => $this->selectedProduct
            ]
        );
    }

    public function EliminarSeleccionados()
    {
        $auxi = 0;
        foreach ($this->selectedProduct as $data) {

            $product = Product::find($data);
            $product->destinos->count() > 0 ? $auxi++ : '';
            $product->detalleCompra->count() > 0 ? $auxi++ : '';
            $product->detalleSalida->count() > 0 ? $auxi++ :  '';
            $product->detalleTransferencia->count() > 0 ? $auxi++ :  '';
            $this->productError = $product->nombre;
            $this->mensaje_toast = 'Acccion realizada con exito';
            $this->emit('product-deleted');
        }

        if ($auxi != 0) {
            $this->emit('restriccionProducto');
        } else {
            Product::whereIn('id', $this->selectedProduct)->delete();
            $this->selectedProduct = [];
            $this->checkAll = false;
        }
    }
    // final Opcion de eliminar multiples datos

    public function export()
    {
        return Excel::download(new ExportExcelProductosController, 'productos.xlsx');
    }

    public function downloadex()
    {
        return Storage::disk('public')->download('plantilla_productos.xlsx');
    }





    public function mostrarOperacionInicial()
    {
        if ($this->stockswitch == true) {
            $this->stockswitch = false;
        } else {
            $this->stockswitch = true;
        }
    }

    public function updatedCostoUnitario()
    {

        if ($this->costoUnitario >= 0 and $this->costoUnitario != "") {

            $this->costoTotal = $this->costoUnitario * $this->cantidad;
        }
    }

    public function updatedCostoTotal()
    {
        if ($this->costoTotal > 0 and $this->cantidad != null) {
            $this->costoUnitario = $this->costoTotal / $this->cantidad;
        }
    }


    public function stockChange()
    {
        if ($this->cantidad > 0) {

            $this->costoTotal = $this->costoUnitario * $this->cantidad;
        }
    }

    public function cambioestado()
    {
        if ($this->estados) {
            $this->estados = false;
        } else {
            $this->estados = true;
        }
    }




    public function resetes()
    {
        $this->failures = false;
    }
}
