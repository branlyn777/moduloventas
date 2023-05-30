<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ExportExcelProductosController;
use App\Imports\ProductsImport;
use App\Imports\PruebaImport;
use App\Models\Ajustes;
use App\Models\Category;
use App\Models\Destino;
use App\Models\DetalleAjustes;
use App\Models\DetalleEntradaProductos;
use App\Models\DetalleSalidaProductos;
use App\Models\IngresoProductos;
use App\Models\Location;
use App\Models\Lote;
use App\Models\Marca;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\SalidaLote;
use App\Models\SalidaProductos;
use App\Models\Sucursal;
use App\Models\SucursalUser;
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
    public $nombre, $costo, $precio_venta, $cantidad_minima, $name, $descripcion, $grouped, $productid, $nombre_prodlote, $loteproducto, $lote_id, $costo_lote, $selected_mood, $lotecantidad, $prod_name,
        $estado_lote, $nuevo_cantidad, $observacion, $prod_stock, $costoAjuste, $pv_lote, $prod_id, $select_operacion, $tipo_proceso,
        $codigo, $lote, $unidad, $industria, $caracteristicas, $status, $categoryid = null, $search, $estado, $stockswitch,
        $image, $imagen, $selected_id, $pageTitle, $componentName, $cate, $marca, $garantia, $stock, $stock_v, $selected_categoria, $selected_sub, $nro = 1, $sub, $change = [], $estados, $searchData = [], $data2, $archivo, $failures, $productError,
        $cantidad, $costoUnitario, $costoTotal, $destinosp, $destino, $precioVenta, $pr, $prod_sel, $sucursalAjuste, $destinoAjuste, $sucursales, $destinos;
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
        $this->pr = collect();
        $this->sucursalAjuste = null;
        $this->destinoAjuste = null;
        $this->prod_stock = 0;
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

        $this->sucursales = Sucursal::all();
        $this->destinos = Destino::where('sucursal_id', $this->sucursalAjuste)->get();
        $this->prod_stock = 0;

        $this->sub = Category::where('categories.categoria_padre', $this->selected_categoria)->get();

        if ($this->destinoAjuste != null) {

            $this->prod_stock = ProductosDestino::where('product_id', $this->prod_id->id)
                ->where('destino_id', $this->destinoAjuste)
                ->get();
            if ($this->prod_stock->isNotEmpty()) {
                $this->prod_stock = $this->prod_stock->first()->stock;
            } else {
                $this->prod_stock = 0;
            }

            if ($this->nuevo_cantidad > $this->prod_stock) {
                $lote = Lote::where('product_id', $this->prod_id->id)->latest()->first();
                if ($lote != null) {

                    $this->costoAjuste = $lote->costo;
                    $this->pv_lote = $lote->pv_lote;
                }
            }
        }

        $prod = Product::join('categories as c', 'products.category_id', 'c.id')
        ->join('productos_destinos', 'productos_destinos.product_id', 'products.id')
        ->select('products.*', DB::raw("SUM(productos_destinos.stock) as cantidad"))
        ->where('products.status', $this->estados == true ? 'ACTIVO' : 'INACTIVO')
        ->when($this->search != null, function ($query) {
            $query->where(function ($query) {
                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('products.caracteristicas', 'like', '%' . $this->search . '%')
                    ->orWhere('products.marca', 'like', '%' . $this->search . '%')
                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
            })
            ->orderByRaw("CASE
                WHEN products.nombre LIKE '%" . $this->search . "%' THEN 1
                WHEN products.caracteristicas LIKE '%" . $this->search . "%' THEN 2
                WHEN products.marca LIKE '%" . $this->search . "%' THEN 3
                WHEN products.codigo LIKE '%" . $this->search . "%' THEN 4
                ELSE 5
            END");
        })
            ->when($this->selected_categoria != null and $this->selected_sub == null, function ($query) {
                $query->where('c.id', $this->selected_categoria)
                    ->where('c.categoria_padre', 0);
            })
            ->when($this->selected_sub != null, function ($query) {
                $query->where('c.id', $this->selected_sub)
                    ->where('categoria_padre', '!=', 0);
            })
            ->when($this->selected_mood == 'cero', function ($query) {
                return $query->where('stock', 0);
            })
            ->when($this->selected_mood == 'bajo', function ($query) {
                return $query->whereColumn('stock', '<', 'cantidad_minima');
            })
            ->when($this->selected_mood == 'positivo', function ($query) {

                return $query->where('stock', '>', 0);
            })
            ->when($this->selected_mood == 'masvendidosmes', function ($query) {
                $subquery = Product::join('sale_details', 'sale_details.product_id', '=', 'products.id')
                    ->join('sales as s', 's.id', '=', 'sale_details.sale_id')
                    ->where('s.status', 'PAID')
                    ->whereMonth('s.created_at', now())
                    ->groupBy('products.id')
                    ->selectRaw('products.*, SUM(sale_details.quantity) as cant')
                    ->orderByRaw('SUM(sale_details.quantity) DESC')
                    ->getQuery();

                return $query->joinSub($subquery, 'mas_vendidos', function ($join) {
                    $join->on('products.id', '=', 'mas_vendidos.id');
                })
                    ->select('products.*', DB::raw("SUM(productos_destinos.stock) as cantidad"))
                    ->orderBy('mas_vendidos.cant', 'desc')
                    ->where('products.status', 'ACTIVO');
            })





            ->when($this->selected_mood == 'masvendidostrimestre', function ($query) {

                $subquery = Product::join('sale_details', 'sale_details.product_id', '=', 'products.id')
                    ->join('sales as s', 's.id', '=', 'sale_details.sale_id')
                    ->where('s.status', 'PAID')
                    ->whereBetween('s.created_at', [now()
                    ->subMonth(3)->startOfDay(), now()->endOfDay()])
                    ->groupBy('products.id')
                    ->selectRaw('products.*, SUM(sale_details.quantity) as cant')
                    ->orderByRaw('SUM(sale_details.quantity) DESC')
                    ->getQuery();

                return $query->joinSub($subquery, 'mas_vendidos', function ($join) {
                    $join->on('products.id', '=', 'mas_vendidos.id');
                })
                    ->select('products.*', DB::raw("SUM(productos_destinos.stock) as cantidad"))
                    ->orderBy('mas_vendidos.cant', 'desc')
                    ->where('products.status', 'ACTIVO');





              
            })
            ->when($this->selected_mood == 'masvendidosanio', function ($query) {

                $subquery = Product::join('sale_details', 'sale_details.product_id', '=', 'products.id')
                ->join('sales as s', 's.id', '=', 'sale_details.sale_id')
                ->where('s.status', 'PAID')
                ->whereYear('s.created_at', now())
                ->groupBy('products.id')
                ->selectRaw('products.*, SUM(sale_details.quantity) as cant')
                ->orderByRaw('SUM(sale_details.quantity) DESC')
                ->getQuery();

            return $query->joinSub($subquery, 'mas_vendidos', function ($join) {
                $join->on('products.id', '=', 'mas_vendidos.id');
            })
                ->select('products.*', DB::raw("SUM(productos_destinos.stock) as cantidad"))
                ->orderBy('mas_vendidos.cant', 'desc')
                ->where('products.status', 'ACTIVO');
            })
            ->groupBy('productos_destinos.product_id')
            ->orderBy('products.created_at', 'desc');


        $ss = Category::select('categories.*')->where('categoria_padre', $this->selected_id2)
            ->get();

        if (count($this->searchData) > 0) {

            foreach ($this->searchData as $data) {
                $this->data2 = $data;
                $prod = $prod->where(function ($querys) {
                    $querys->where('products.nombre', 'like', '%' . $this->data2 . '%')
                        ->orWhere('products.codigo', 'like', '%' . $this->data2 . '%')
                        ->orWhere('c.name', 'like', '%' . $this->data2 . '%')
                        ->orWhere('products.marca', 'like', '%' . $this->data2 . '%')
                        ->orWhere('products.caracteristicas', 'like', '%' . $this->data2 . '%')
                        ->orWhere('products.costo', 'like', '%' . $this->data2 . '%')
                        ->orWhere('products.precio_venta', 'like', '%' . $this->data2 . '%');
                })


                    ->orderBy('products.created_at', 'desc');
            }
        }

        if ($this->productid != null) {
            $this->loteproducto = Lote::where('product_id', $this->productid)->where('status', $this->estados)->get();
        }

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



            ];

            $messages = [
                'cantidad.required' => 'Agregue una cantidad',
                'cantidad.min' => 'Agregue una cantidad mayor a 0',
                'costoUnitario.required' => 'Agregue un costo para el ingreso inicial.',


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
            } else {
                foreach (Destino::all() as $destino) {
                
                    ProductosDestino::updateOrCreate(['product_id' => $product->id, 'destino_id' => $destino->id], ['stock' => 0]);
                }
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

        //dd($this->searchData);
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
        $this->productError = collect();
        $auxi = 0;
        foreach ($this->selectedProduct as $data) {

            $product = Product::find($data);

            $product->detalleCompra->count() > 0 && $auxi++;
            $product->detalleSalida->count() > 0 && $auxi++;
            $product->detalleTransferencia->count() > 0 && $auxi++;

            if ($auxi > 0) {
                $this->productError->add($product->nombre);
            }
            $auxi = 0;
        }

        if ($this->productError->count() > 0) {
            $this->emit('prod_observados');
        } else {

            $this->dispatchBrowserEvent(
                'swal:EliminarSelect',
                [
                    'title' => 'PRECAUCION',
                    'id' => $this->selectedProduct
                ]
            );
        }
    }

    public function EliminarSeleccionados()
    {
        ProductosDestino::whereIn('product_id', $this->selectedProduct)->delete();
        Product::whereIn('id', $this->selectedProduct)->delete();
        $this->selectedProduct = [];
        $this->checkAll = false;
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


    public function lotes($id)
    {
        $this->grouped = false;
        $this->productid = $id;
        $this->nombre_prodlote = Product::find($id)->nombre;

        //Obteniendo el precio de venta del producto
        $this->precio_actual = Lote::select("pv_lote")
            ->where("lotes.product_id", $id)
            ->orderBy("lotes.created_at", "desc")
            ->first()->pv_lote;

        $this->emit('show-modal-lotes');
    }

    //Muestra la ventana modal para cambiar el costo de un lote
    public function modal_costo_lote($idlote)
    {
        $this->lote_id = $idlote;
        $this->costo_lote = Lote::find($idlote)->costo;
        $this->emit("hide-modal-lote");
        $this->emit("show-modal-lotecosto");
    }

    public function actualizar_precio()
    {
        $precio = Lote::select("id")
            ->where("lotes.product_id", $this->productid)
            ->orderBy("lotes.created_at", "desc")
            ->first();

        $lote = Lote::find($precio->id);

        $lote->update([
            'pv_lote' => $this->precio_actual,
        ]);
        $this->emit("hide-modal-lote");
    }
    //Actualiza el costo de un produto (updated en la tabla lote)
    public function actualizar_costo()
    {
        $lote = Lote::find($this->lote_id);
        $lote->update([
            'costo' => $this->costo_lote,
        ]);
        $this->emit("hide-modal-lotecosto");
        $this->emit("show-modal-lotes");
    }

    public function resetAjuste()
    {
        $this->prod_stock = null;
        $this->nuevo_cantidad = null;
        $this->costoAjuste = null;
        $this->pv_lote = null;
        $this->observacion = null;
        $this->prod_id = null;
        $this->prod_name = null;
        $this->tipo_proceso = null;
        $this->destinoAjuste = null;
        $this->sucursalAjuste = null;
    }

    public function guardarAjuste()
    {

        $rules = [
            'sucursalAjuste' => 'required|not_in:null',
            'destinoAjuste' => 'required|not_in:null',
            'nuevo_cantidad' => 'required',

        ];

        if ($this->nuevo_cantidad > $this->prod_stock) {
            $rules = [
                'costoAjuste' => 'required',
                'pv_lote' => 'required',
            ];
        }

        $messages = [
            'sucursalAjuste.required' => 'Selccione una sucursal',
            'sucursalAjuste.not_in' => 'Elija una sucursal',
            'destinoAjuste.required' => 'El destino es obligatorio',
            'destinoAjuste.not_in' => 'Elija un destino',
            'nuevo_cantidad.required' => 'Ingrese una cantidad de ajuste',
            'costoAjuste.required' => 'Introduzca un numero valido para el ajuste',
            'pv_lote.required' => 'Introduzca un numero valido para el ajuste'

        ];
        $this->validate($rules, $messages);
        try {

            $ajuste = Ajustes::create([
                'destino' => $this->destinoAjuste,
                'user_id' => Auth()->user()->id,
                'observacion' => $this->observacion ?? 's/n observaciones'
            ]);

            DetalleAjustes::create([
                'product_id' => $this->prod_id->id,
                'recuentofisico' => $this->nuevo_cantidad,
                'diferencia' => $this->nuevo_cantidad - $this->prod_stock > 0 ? $this->nuevo_cantidad - $this->prod_stock : ($this->nuevo_cantidad - $this->prod_stock) * -1,
                'tipo' => $this->nuevo_cantidad - $this->prod_stock > 0 ? 'positiva' : 'negativa',
                'id_ajuste' => $ajuste->id

            ]);

            if ($this->nuevo_cantidad > $this->prod_stock) {


                $lot = Lote::where('product_id', $this->prod_id->id)->where('status', 'Activo')->first();
                $lot = Lote::create([
                    'existencia' => $this->nuevo_cantidad - $this->prod_stock,
                    'costo' => $this->costoAjuste,
                    'pv_lote' => $this->pv_lote,
                    'status' => 'Activo',
                    'product_id' => $this->prod_id->id
                ]);
            } else {
                $lot = Lote::where('product_id', $this->prod_id->id)->where('status', 'Activo')->get();
                //obtener la cantidad del detalle de la venta 
                $qq = $this->prod_stock - $this->nuevo_cantidad; //q=8
                foreach ($lot as $val) {
                    //lote1= 3 Lote2=3 Lote3=3
                    $this->lotecantidad = $val->existencia;
                    //dd($this->lotecantidad);
                    if ($qq >= 0) {
                        //true//5//2
                        //dd($val);
                        if ($qq >= $this->lotecantidad) {

                            $val->update([
                                'existencia' => 0,
                                'status' => 'Inactivo'

                            ]);
                            $val->save();
                            $qq = $qq - $this->lotecantidad;
                            //dump("dam",$qq);
                        } else {
                            //dd($this->lotecantidad);
                            $val->update([
                                'existencia' => $this->lotecantidad - $qq
                            ]);
                            $val->save();
                            $qq = 0;
                            //dd("yumi",$qq);
                        }
                    }
                }
            }


            ProductosDestino::updateOrCreate(['product_id' => $this->prod_id->id, 'destino_id' => $this->destinoAjuste], ['stock' => $this->nuevo_cantidad]);


            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

        $this->emit('hide-modal-ajuste');
        $this->resetAjuste();
    }

    public function guardarEntradaSalida()
    {
        if ($this->tipo_proceso == 'INGRESO') {
            DB::beginTransaction();
            try {
                $rs = IngresoProductos::create([
                    'destino' => $this->destinoAjuste,
                    'user_id' => Auth()->user()->id,
                    'concepto' => $this->tipo_proceso,
                    'observacion' => $this->observacion
                ]);

                $lot = Lote::create([
                    'existencia' => $this->nuevo_cantidad,
                    'costo' => $this->costoAjuste,
                    'status' => 'Activo',
                    'product_id' => $this->prod_id->id,
                    'pv_lote' => $this->pv_lote
                ]);

                DetalleEntradaProductos::create([
                    'product_id' => $this->prod_id->id,
                    'cantidad' => $this->nuevo_cantidad,
                    'costo' => $this->costoAjuste,
                    'id_entrada' => $rs->id,
                    'lote_id' => $lot->id
                ]);

                $q = ProductosDestino::where('product_id', $this->prod_id->id)->where('destino_id', $this->destinoAjuste)->value('stock');

                ProductosDestino::updateOrCreate(['product_id' => $this->prod_id->id, 'destino_id' => $this->destinoAjuste], ['stock' => $q + $this->nuevo_cantidad]);


                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                dd($e->getMessage());
            }
        } else {
            try {
                $operacion = SalidaProductos::create([
                    'destino' => $this->destinoAjuste,
                    'user_id' => Auth()->user()->id,
                    'concepto' => 1,
                    'observacion' => $this->observacion
                ]);




                $auxi = DetalleSalidaProductos::create([
                    'product_id' => $this->prod_id,
                    'cantidad' => $this->nuevo_cantidad,
                    'id_salida' => $operacion->id
                ]);


                $lot = Lote::where('product_id', $this->prod_id->id)->where('status', 'Activo')->get();

                //obtener la cantidad del detalle de la venta 
                $qq = $this->nuevo_cantidad; //q=8
                foreach ($lot as $val) {
                    //lote1= 3 Lote2=3 Lote3=3
                    $this->lotecantidad = $val->existencia;
                    //dd($this->lotecantidad);
                    if ($qq > 0) {
                        //true//5//2
                        //dd($val);
                        if ($qq >= $this->lotecantidad) {
                            $ss = SalidaLote::create([
                                'salida_detalle_id' => $auxi->id,
                                'lote_id' => $val->id,
                                'cantidad' => $val->existencia
                            ]);
                            $val->update([

                                'existencia' => 0,
                                'status' => 'Inactivo'

                            ]);
                            $val->save();
                            $qq = $qq - $this->lotecantidad;
                            //dump("dam",$this->qq);
                        } else {
                            //dd($this->lotecantidad);
                            $ss = SalidaLote::create([
                                'salida_detalle_id' => $auxi->id,
                                'lote_id' => $val->id,
                                'cantidad' => $qq

                            ]);


                            $val->update([
                                'existencia' => $this->lotecantidad - $qq
                            ]);
                            $val->save();
                            $qq = 0;
                        }
                    }
                }


                $q = ProductosDestino::where('product_id', $this->prod_id->id)
                    ->where('destino_id', $this->destino)->value('stock');

                $varm = $this->nuevo_cantidad;


                ProductosDestino::updateOrCreate(['product_id' => $this->prod_id->id, 'destino_id' => $this->destinoAjuste], ['stock' => $q - $varm]);


                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                dd($e->getMessage());
            }
        }
        $this->emit('hide-modal-ent_sal');
        $this->resetEntradaSalida();
    }


    public function abrirModalAjuste($producto)
    {
        $this->pr = collect();
        $this->resetAjuste();
        $this->prod_id = $producto;
        $this->prod_id = Product::find($producto);
    }

    public function abrirModalE_S($producto)
    {
        $this->pr = collect();
        $this->resetEntradaSalida();
        $this->prod_id = Product::find($producto);
    }

    public function resetEntradaSalida()
    {
        $this->prod_id = null;
        $this->select_operacion = null;
        $this->nuevo_cantidad = null;
        $this->costoAjuste = null;
        $this->pv_lote = null;
        $this->observacion = null;
        $this->prod_name = null;
        $this->tipo_proceso = null;
        $this->destinoAjuste = null;
        $this->sucursalAjuste = null;
        $this->prod_stock = null;
    }

    public function verUbicacion($prod_id)
    {
        $this->prod_sel = Product::find($prod_id)->nombre;
        $this->pr = ProductosDestino::where('product_id', $prod_id)->select('productos_destinos.*', DB::raw('0 as mob'))->get();

        foreach ($this->pr as $value) {
            $value->mob = Location::join('location_productos', 'location_productos.location', 'locations.id')
                ->where('locations.destino_id', $value->destino_id)
                ->where('location_productos.product', $value->product_id)->get();
        }

        $this->emit('abrirUbicacion');
    }
}
