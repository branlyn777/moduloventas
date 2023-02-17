<?php

use App\Http\Controllers\ExportSaleController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\CajasController;
use App\Http\Livewire\CarteraController;
use App\Http\Livewire\CarteraMovCategoriaController;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\ClienteController;
use App\Http\Controllers\ExportTransferenciaController;
use App\Http\Livewire\EditTransferenceController;
use App\Http\Controllers\ExportComprasController;
use App\Http\Controllers\ExportSaleMovDiaController;
use App\Http\Livewire\CoinsController;
use App\Http\Livewire\CompaniesController;
use App\Http\Livewire\ComprasController;
use App\Http\Livewire\OrdenCompraController;
use App\Http\Livewire\OrdenCompraDetalleController;
use App\Http\Livewire\EditarCompraDetalleController;
use App\Http\Livewire\CorteCaja2Controller;
use App\Http\Livewire\CorteCajaController;
use App\Http\Livewire\DestinoController;
use App\Http\Livewire\DestinoProductoController;
use App\Http\Livewire\DetalleComprasController;
use App\Http\Livewire\IngresoEgresoController;
use App\Http\Livewire\InicioController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\ExportMovDiaResController;
use App\Http\Controllers\ExportMovDiaSesionController;
use App\Http\Controllers\ExportMovimientoController;
use App\Http\Controllers\ExportTigoPdfController;
use App\Http\Livewire\ArqueosTigoController;
use App\Http\Livewire\CierreCajaController;
use App\Http\Livewire\ComisionesController;
use App\Http\Livewire\CotizationController;
use App\Http\Livewire\LocalizacionController;
use App\Http\Livewire\MarcasController;
use App\Http\Livewire\MercanciaController;
use App\Http\Livewire\MotivoController;
use App\Http\Livewire\OrdenCompra;
use App\Http\Livewire\OrigenController;
use App\Http\Livewire\OrigenMotivoComisionController;
use App\Http\Livewire\OrigenMotivoController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\PosController;
use App\Http\Livewire\ProcedenciaController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\NivelInventariosController;
use App\Http\Livewire\ProvidersController;
use App\Http\Livewire\RegistrarAjuste;
use App\Http\Livewire\ReporGananciaTgController;
use App\Http\Livewire\ReporteJornadaTMController;
use App\Http\Livewire\ReporteMovimientoResumenController;
use App\Http\Livewire\ReportesTigoController;
use App\Http\Livewire\ResumenSesionController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\SaleDailyMovementController;
use App\Http\Livewire\SaleDevolucionController;
use App\Http\Livewire\SaleDevolutionController;
use App\Http\Livewire\SaleEditController;
use App\Http\Livewire\SaleListController;
use App\Http\Livewire\SaleListProductsController;
use App\Http\Livewire\SaleReporteCantidadController;
use App\Http\Livewire\SaleReportProductController;
use App\Http\Livewire\SesionesListaController;
use App\Http\Livewire\SucursalController;
use App\Http\Livewire\TransaccionController;
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
    Route::get('cajacierre/{id}', CierreCajaController::class)->name('caja.cierre')->middleware('permission:Corte_Caja_Index');
    //Route::get('cajacierre/{id}', array('as'=> 'cajacierre.id', 'uses' => 'CierreCajaController'));
    //Route::get('itsolutionstuff/tag/{id}', array('as'=> 'itsolutionstuff.tag', 'uses' => 'HomeController@tags'));

    Route::get('resumenmovimientos',ReporteMovimientoResumenController::class)->name('r_movimiento');
    Route::get('sesiones',SesionesListaController::class)->name('sesioneslista');
    Route::get('/sesiones/{id}',ResumenSesionController::class)->name('sesiones');
    Route::get('report/pdfmovdiaresumen', [ExportMovDiaResController::class, 'reportPDFMovDiaResumen']);
    Route::get('sesiones/report/pdfmovdiasesion', [ExportMovDiaSesionController::class, 'reportPDFMovDiaSesion']);
    Route::get('cotizacion', CotizationController::class)->name('cotizacion');
    Route::get('ingresoegreso', IngresoEgresoController::class)->name('ingreso_egreso');




    /* TIGO MONEY */
    Route::get('origenes', OrigenController::class)->name('origen')->middleware('permission:Origen_Index');
    Route::get('motivos', MotivoController::class)->name('motivo')->middleware('permission:Motivo_Index');
    Route::get('comisiones', ComisionesController::class)->name('comision')->middleware('permission:Comision_Index');
    Route::get('origen-motivo', OrigenMotivoController::class)->name('origenmot')->middleware('permission:Origen_Mot_Index');
    Route::get('origen-motivo-comision', OrigenMotivoComisionController::class)->name('origenmotcom')->middleware('permission:Origen_Mot_Com_Index');
    Route::get('tigomoney', TransaccionController::class)->name('tigomoney')->middleware('permission:Tigo_Money_Index');
    Route::get('arqueostigo', ArqueosTigoController::class)->name('arqueostigo')->middleware('permission:Arqueos_Tigo_Index');
    Route::get('reportestigo', ReportesTigoController::class)->name('reportestigo')->middleware('permission:Reportes_Tigo_Index');
    Route::get('Movimientodiario/pdf', [ExportMovimientoController::class, 'printPdf'])->name('movimiento.pdf');
    Route::get('ReporteGananciaTg', ReporGananciaTgController::class)->name('ReporteGananciaTg')->middleware('permission:Rep_Gan_Tigo_Index');
    Route::group(['middleware' => ['permission:Report_Tigo_Export']], function () {
        Route::get('reporteTigo/pdf/{user}/{type}/{origen}/{motivo}/{f1}/{f2}', [ExportTigoPdfController::class, 'reporteTigoPDF']);
        Route::get('reporteTigo/pdf/{user}/{type}/{origen}/{motivo}', [ExportTigoPdfController::class, 'reporteTigoPDF']);
    });
    //Route::group(['middleware' => ['permission:Report_Ganancia_Tigo_Export']], function () {
    //     Route::get('reporteGananciaTigoM/pdf/{user}/{type}/{f1}/{f2}', [TigoGananciaPdfController::class, 'reporte']);
        //   Route::get('reporteGananciaTigoM/pdf/{user}/{type}', [TigoGananciaPdfController::class, 'reporte']);
    // });
    Route::get('ReporteJornalTM', ReporteJornadaTMController::class)->name('reportejornadatm');







    // VENTAS
    Route::get('monedas', CoinsController::class)->name('monedas')->middleware('permission:Coins_Index');
    Route::get('pos', PosController::class)->name('ventas')->middleware('permission:Sales_Index');
    Route::get('ventasreportecantidad', SaleReporteCantidadController::class)->name('ventasreportecantidad')->middleware('permission:Reportes_Sale_Index');
    Route::get('salelist', SaleListController::class)->name('salelist')->middleware('permission:VentasLista_Index');
    Route::get('editarventa', SaleEditController::class)->name('editarventa');
    Route::get('devolucionventa', SaleDevolutionController::class)->name('devolucionventa');
    Route::get('devolucionventa2', SaleDevolucionController::class)->name('devolucionventa2');
    Route::get('productosvendidos', SaleReportProductController::class)->name('productosvendidos');
    Route::get('ventalistaproductos', SaleListProductsController::class)->name('ventalistaproductos');
    Route::get('salemovimientodiario', SaleDailyMovementController::class)->name('salemovimientodiario')->middleware('permission:VentasMovDia_Index');
    //Ventas Pdf
    Route::get('report/pdf/{total}/{idventa}/{totalitems}', [ExportSaleController::class, 'reportPDFVenta']);
    Route::get('report/pdfmovdia', [ExportSaleMovDiaController::class, 'reportPDFMovDiaVenta']);


    //INVENTARIOS
    Route::group(['middleware' => ['permission:Inventarios']], function () {
        Route::get('proveedores', ProvidersController::class)->name('supliers');
        Route::get('categories', CategoriesController::class)->name('categorias');
        Route::get('destino', DestinoController::class)->name('dest');
        Route::get('locations', LocalizacionController::class)->name('locations');
        Route::get('unidades', UnidadesController::class)->name('unities');
        Route::get('marcas', MarcasController::class)->name('brands');
        Route::get('nivelinventarios', NivelInventariosController::class)->name('nivel_inventarios');
    });
    Route::get('products', ProductsController::class)->name('productos');
    Route::group(['middleware' => ['permission:Transferencias']], function () {
        Route::get('all_transferencias', TransferenciasController::class);
        Route::get('transferencia', TransferirProductoController::class)->name('operacionTransferencia');
        Route::get('trans', EditTransferenceController::class)->name('editdest');
    });
    Route::get('operacionesinv', MercanciaController::class)->name('operacionesinv')->middleware('permission:Entradas_Salidas');
    Route::get('registraroperacion', RegistrarAjuste::class)->name('registraroperacion')->middleware('permission:Entradas_Salidas');
    Route::get('destino_prod', DestinoProductoController::class)->name('destination');

    Route::group(['middleware' => ['permission:Compras']], function () {
        Route::get('compras', ComprasController::class)->name('compras');
        Route::get('editar_compra', EditarCompraDetalleController::class)->name('editcompra');
        Route::get('detalle_compras', DetalleComprasController::class)->name('detalle_compra');
        Route::get('orden_compras', OrdenCompraController::class)->name('orden_compra');
        Route::get('detalle_orden_compras', OrdenCompraDetalleController::class)->name('orden_compra_detalle');
    });
    //Inventarios (Pdsf y Excel)
 
        Route::get('Compras/pdf/{id}', [ExportComprasController::class, 'PrintCompraPdf']);
        Route::get('OrdenCompra/pdf/{id}', [ExportComprasController::class, 'PrintOrdenCompraPdf']);
        Route::get('Transferencia/pdf', [ExportTransferenciaController::class, 'printPdf'])->name('transferencia.pdf');
        Route::get('reporteCompras/pdf/{filtro}/{fecha}/{fromDate}/{toDate}/{data?}', [ExportComprasController::class, 'reporteComprasPdf']);
        Route::get('productos/export/', [ProductsController::class, 'export']);
        Route::get('almacen/export/{destino}/{stock}', [DestinoProductoController::class, 'export']);

    Route::get('chart', [ChartJSController::class, 'index']);
});
