<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ADMINISTRACION */
        Permission::create([
            'name' => 'Reporte_Movimientos_General',
            'areaspermissions_id' => '1',
            'descripcion' => 'Reporta el Movimiento Diario por Sucursales.',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Admin_Views',
            'areaspermissions_id' => '1',
            'descripcion' => 'Visualización de la información solo para administradores.',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Administracion_Sidebar',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ver administración en el Sidebar.',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ROLES */
            'name' => 'Roles_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingreso a "Roles".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A PERMISOS */
            'name' => 'Permission_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingreso a "Permisos".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ASIGNAR PERMISO */
            'name' => 'Asignar_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingreso a "Asignar Permiso".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A USUARIOS */
            'name' => 'Usuarios_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingreso a "Usuarios".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CLIENTE */
            'name' => 'Cliente_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingreso a "Cliente".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A PROCEDENCIA */
            'name' => 'Procedencia_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingreso a "Procedencia Clientes".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A EMPRESA */
            'name' => 'Empresa_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingreso a "Empresa (Compañía)".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A SUCURSAL */
            'name' => 'Sucursal_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingreso a "Sucursal".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CAJA */
            'name' => 'Caja_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ingreso a "Caja".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CARTERA */
            'name' => 'Cartera_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ingreso a "Cartera".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CORTE DE CAJA */
            'name' => 'Corte_Caja_Index',
            'areaspermissions_id' => '3',
            'descripcion' => 'Ingreso a "Corte de Caja".',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CORTE DE CAJA */
            'name' => 'Ver_Generar_Ingreso_Egreso_Boton',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ocultar el botón Ingreso Egreso del modulo "Ingreso Egreso".',
            'guard_name' => 'web'
        ]);



        /* TIGO MONEY */
        Permission::create([    /* INGRESAR A ORIGEN CRUD */
            'name' => 'Origen_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A MOTIVO CRUD */
            'name' => 'Motivo_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A COMISION CRUD */
            'name' => 'Comision_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ORIGEN MOTIVO */
            'name' => 'Origen_Mot_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ORIGEN MOTIVO COMISION */
            'name' => 'Origen_Mot_Com_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A LA TRANSACCION */
            'name' => 'Tigo_Money_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A LOS ARQUEOS */
            'name' => 'Arqueos_Tigo_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A REPORTES TIGO MONEY */
            'name' => 'Reportes_Tigo_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A REPORTE GANANCIAS TIGO MONEY */
            'name' => 'Rep_Gan_Tigo_Index',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* PERMITIR SACAR PDF REPORTE DE TIGO MONEY*/
            'name' => 'Report_Tigo_Export',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* PERMITIR SACAR PDF REPORTE DE LAS GANANCIAS TIGO MONEY */
            'name' => 'Report_Ganancia_Tigo_Export',
            'areaspermissions_id' => '5',
            'guard_name' => 'web'
        ]);









        /* VENTAS */
        Permission::create([    /* INGRESAR A COINS */
            'name' => 'Coins_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Creación de Monedas para las Ventas.',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A VENTAS */
            'name' => 'Sales_Index',
            'areaspermissions_id' => '3',
            'descripcion' => 'Realización de ventas.',
            'guard_name' => 'web'
        ]);

        //Poder filtrar y Anular una devolucion
        /*  Permission::create([
            'name' => 'VentasDevolucionesFiltrar',
            'areaspermissions_id' => '4',
            'descripcion' => 'Poder filtrar y Anular una devolucion',
            'guard_name' =>'web'
        ]); */

        //Poder ver el movimiento Diario de Ventas filtrando por sucursal y poder ver la utilidad
        Permission::create([
            'name' => 'VentasMovDiaSucursalUtilidad',
            'areaspermissions_id' => '4',
            'descripcion' => 'Visualizar el movimiento Diario de Ventas + Filtros (Por Sucursal, Ver Utilidad).',
            'guard_name' => 'web'
        ]);

        /* PERMITIR VER REPORTES DE LA CANTIDAD DE VENTAS POR USUARIO */
        /*  Permission::create([   
            'name' => 'Reportes_Sale_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ver Reportes de Ventas',
            'guard_name' => 'web'
        ]); */

        //Poder ver el movimiento Diario de Ventas (Sin poder filtrar por Sucursal y ver Utilidad)
        Permission::create([
            'name' => 'VentasMovDia_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Visualizar el movimiento diario de "Ventas".',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'VentasLista_Index',
            'areaspermissions_id' => '3',
            'descripcion' => 'Visualizar lista de las ventas realizadas por el usuario logeado.',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'VentasListaMasFiltros',
            'areaspermissions_id' => '4',
            'descripcion' => 'Visualizar la lista de Ventas con + Filtros (Ventas por Usuario).',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'Inventarios',
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingreso a la vista de "Productos", "Proveedores", "Categorías".',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Entradas_Salidas',
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingreso a la vista de "Entrada y Salida" de productos.',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Compras',
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingreso y visualización de la rutas de las compras.',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Almacenes',
            'areaspermissions_id' => '2',
            'descripcion' => '	Ingreso y visualización del almacén producto (Stocks de los Almacenes de cada sucursal).',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Transferencias',
            'areaspermissions_id' => '2',
            'descripcion' => 'Ingreso a la vista de "Transferencias".',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Reportes_Inventarios_Export',
            'areaspermissions_id' => '2',
            'descripcion' => 'Descarga archivos PDF y archivos Excel de "Inventarios".',
            'guard_name' => 'web'
        ]);



        //INVENTARIOS
    }
}
