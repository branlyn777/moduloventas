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
            'descripcion' => 'Reporte de Movimientos por Sucursales',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Admin_Views',
            'areaspermissions_id' => '1',
            'descripcion' => 'Permitir ver informacion solo para administadores',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Administracion_Sidebar',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ver Adminitración en el Sidebar',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ROLES */
            'name' => 'Roles_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingresar a Roles',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A PERMISOS */
            'name' => 'Permission_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingresar a Permisos',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ASIGNAR PERMISO */
            'name' => 'Asignar_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingresar a Asignar Permiso',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A USUARIOS */
            'name' => 'Usuarios_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingresar a Usuarios',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CLIENTE */
            'name' => 'Cliente_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingresar a Cliente',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A PROCEDENCIA */
            'name' => 'Procedencia_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingresar a Procedencia Clientes',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A EMPRESA */
            'name' => 'Empresa_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingresar a Empresa (Compañía)',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A SUCURSAL */
            'name' => 'Sucursal_Index',
            'areaspermissions_id' => '1',
            'descripcion' => 'Ingresar a Sucursal',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CAJA */
            'name' => 'Caja_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ingresar a Caja',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CARTERA */
            'name' => 'Cartera_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ingresar a Cartera',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CORTE DE CAJA */
            'name' => 'Corte_Caja_Index',
            'areaspermissions_id' => '3',
            'descripcion' => 'Ingresar a Corte de Caja',
            'guard_name' => 'web'
        ]);



    





        /* VENTAS */
        Permission::create([    /* INGRESAR A COINS */
            'name' => 'Coins_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Crear Monedas para las Ventas',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A VENTAS */
            'name' => 'Sales_Index',
            'areaspermissions_id' => '3',
            'descripcion' => 'Poder realizar ventas',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A REPORTES VENTAS */
            'name' => 'Reportes_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ingresar a Reporte movimiento Diario Ventas',
            'guard_name' => 'web'
        ]);
        //Poder filtrar y Anular una devolucion
        Permission::create([
            'name' => 'VentasDevolucionesFiltrar',
            'areaspermissions_id' => '4',
            'descripcion' => 'Poder filtrar y Anular una devolucion',
            'guard_name' =>'web'
        ]);
        //Poder ver el movimiento Diario de Ventas filtrando por sucursal y poder ver la utilidad
        Permission::create([
            'name' => 'VentasMovDiaSucursalUtilidad',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ver el movimiento Diario de Ventas + Filtros (Por Sucursal, Ver Utilidad)',
            'guard_name' =>'web'
        ]);

        Permission::create([    /* PERMITIR VER REPORTES DE LA CANTIDAD DE VENTAS POR USUARIO */
            'name' => 'Reportes_Sale_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ver Reportes de Ventas',
            'guard_name' => 'web'
        ]);

        //Poder ver el movimiento Diario de Ventas (Sin poder filtrar por Sucursal y ver Utilidad)
        Permission::create([
            'name' => 'VentasMovDia_Index',
            'areaspermissions_id' => '4',
            'descripcion' => 'Ver el movimiento diario de Ventas',
            'guard_name' =>'web'
        ]);

        Permission::create([
            'name' => 'VentasLista_Index',
            'areaspermissions_id' => '3',
            'descripcion' => 'Poder Ver Lista de las Ventas realizados por el usuario logeado',
            'guard_name' =>'web'
        ]);

        Permission::create([
            'name' => 'VentasListaMasFiltros',
            'areaspermissions_id' => '4',
            'descripcion' => 'Poder ver la lista de Ventas con + Filtros (Ventas por Usuario)',
            'guard_name' =>'web'
        ]);

        Permission::create([
            'name' => 'Inventarios_Registros',
            'areaspermissions_id' => '2',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
        Permission::create([
            'name' => 'Compras_Index',
            'areaspermissions_id' => '2',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
        Permission::create([
            'name' => 'Almacen_Index',
            'areaspermissions_id' => '2',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
        Permission::create([
            'name' => 'Transferencia_Index',
            'areaspermissions_id' => '2',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
        Permission::create([
            'name' => 'Reportes_Inventarios_Export',
            'areaspermissions_id' => '2',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);



        //INVENTARIOS
    }
}
