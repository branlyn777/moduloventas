<?php

use App\Http\Controllers\ExportSaleController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\CajasController;
use App\Http\Livewire\CarteraController;
use App\Http\Livewire\CarteraMovCategoriaController;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\ClienteController;
use App\Http\Livewire\CoinsController;
use App\Http\Livewire\CompaniesController;
use App\Http\Livewire\ComprasController;
use App\Http\Livewire\EditarCompraDetalleController;
use App\Http\Livewire\CorteCaja2Controller;
use App\Http\Livewire\CorteCajaController;
use App\Http\Livewire\DestinoController;
use App\Http\Livewire\DestinoProductoController;
use App\Http\Livewire\DetalleComprasController;
use App\Http\Livewire\IngresoEgresoController;
use App\Http\Livewire\InicioController;
use App\Http\Livewire\LocalizacionController;
use App\Http\Livewire\MarcasController;
use App\Http\Livewire\MercanciaController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\PosController;
use App\Http\Livewire\ProcedenciaController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\ProvidersController;
use App\Http\Livewire\ReporteMovimientoResumenController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\SaleDailyMovementController;
use App\Http\Livewire\SaleDevolucionController;
use App\Http\Livewire\SaleDevolutionController;
use App\Http\Livewire\SaleEditController;
use App\Http\Livewire\SaleListController;
use App\Http\Livewire\SaleReporteCantidadController;
use App\Http\Livewire\SucursalController;
use App\Http\Livewire\TransferenciasController;
use App\Http\Livewire\TransferirProductoController;
use App\Http\Livewire\UnidadesController;
use App\Http\Livewire\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', InicioController::class)->name('home');
    Route::get('/home', InicioController::class);
    Route::group(['middleware' => ['role:ADMIN']], function () {
    });
    /* ADMINISTRACION */
    Route::get('roles', RolesController::class)->name('roles')->middleware('permission:Roles_Index');
    Route::get('permisos', PermisosController::class)->name('permisos')->middleware('permission:Permission_Index');
    Route::get('users', UsersController::class)->name('usuarios')->middleware('permission:Usuarios_Index');
    Route::get('asignar', AsignarController::class)->name('asignar')->middleware('permission:Asignar_Index');
    Route::get('clientes', ClienteController::class)->name('cliente')->middleware('permission:Cliente_Index');
    Route::get('procedenciaCli', ProcedenciaController::class)->middleware('permission:Procedencia_Index');
    Route::get('companies', CompaniesController::class)->name('empresa')->middleware('permission:Empresa_Index');
    Route::get('sucursales', SucursalController::class)->name('sucursal')->middleware('permission:Sucursal_Index');
    Route::get('cajas', CajasController::class)->name('caja')->middleware('permission:Caja_Index');
    Route::get('carteras', CarteraController::class)->name('cartera')->middleware('permission:Cartera_Index');
    Route::get('carteramovcategoria', CarteraMovCategoriaController::class)->name('carteramovcategoria');
    Route::get('cortecajas', CorteCajaController::class)->middleware('permission:Corte_Caja_Index');
    Route::get('resumenmovimientos', ReporteMovimientoResumenController::class)->name('r_movimiento');
    Route::get('ingresoegreso', IngresoEgresoController::class)->name('ingreso_egreso');


    // VENTAS
    Route::get('coins', CoinsController::class)->name('monedas')->middleware('permission:Coins_Index');
    Route::get('pos', PosController::class)->name('ventas')->middleware('permission:Sales_Index');
    Route::get('ventasreportecantidad', SaleReporteCantidadController::class)->name('ventasreportecantidad')->middleware('permission:Reportes_Sale_Index');
    Route::get('salelist', SaleListController::class)->name('salelist')->middleware('permission:VentasLista_Index');
    Route::get('editarventa', SaleEditController::class)->name('editarventa');
    Route::get('devolucionventa', SaleDevolutionController::class)->name('devolucionventa');
    Route::get('devolucionventa2', SaleDevolucionController::class)->name('devolucionventa2');
    Route::get('salemovimientodiario', SaleDailyMovementController::class)->name('salemovimientodiario')->middleware('permission:VentasMovDia_Index');
    //Ventas Pdf
    Route::get('report/pdf/{total}/{idventa}/{totalitems}', [ExportSaleController::class, 'reportPDFVenta']);


    //INVENTARIOS
    Route::get('proveedores', ProvidersController::class)->name('supliers');
    Route::get('categories', CategoriesController::class)->name('categorias');
    Route::get('products', ProductsController::class)->name('productos');
    Route::get('compras', ComprasController::class)->name('compras');
    Route::get('destino_prod', DestinoProductoController::class)->name('destination')->middleware('permission:Almacen_Index');
    Route::get('operacionesinv',MercanciaController::class)->name('operacionesinv');
    Route::get('all_transferencias', TransferenciasController::class);
    Route::get('destino', DestinoController::class)->name('dest');
    Route::get('locations', LocalizacionController::class)->name('locations');
    Route::get('unidades', UnidadesController::class)->name('unities');
    Route::get('marcas', MarcasController::class)->name('brands');
    Route::post('importar-cat',[ CategoriesController::class,'import'])->name('importar_cat');
    Route::post('importar-subcat',[ CategoriesController::class,'importsub'])->name('importar_subcat');
    Route::get('detalle_compras', DetalleComprasController::class)->name('detalle_compra');
    Route::get('transferencia', TransferirProductoController::class)->name('operacionTransferencia');
    Route::get('editar_compra',EditarCompraDetalleController::class)->name('editcompra');
    //Inventarios (Pdsf y Excel)
    Route::get('productos/export/', [ProductsController::class, 'export']);


});