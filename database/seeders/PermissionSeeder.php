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
        Permission::create([    /* VER EN EL SIDEBAR REPORTES GENERALES */
            'name' => 'Reporte_Movimientos_General',
            'area' => 'Administracion',
            'descripcion' => 'Reporte de movimientos por Sucursales',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Admin_Views',
            'area' => 'Administracion',
            'descripcion' => '',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'Administracion_Sidebar',
            'area' => 'Administracion',
            'descripcion' => 'Ver Administracion en el Sidebar',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ROLES */
            'name' => 'Roles_Index',
            'area' => 'Administracion',
            'descripcion' => 'Ingresar a Roles',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A PERMISOS */
            'name' => 'Permission_Index',
            'area' => 'Administracion',
            'descripcion' => 'Ingresar a Permisos',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ASIGNAR PERMISO */
            'name' => 'Asignar_Index',
            'area' => 'Administracion',
            'descripcion' => 'Ingresar a Asignar Permiso',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A USUARIOS CRUD */
            'name' => 'Usuarios_Index',
            'area' => 'Administracion',
            'descripcion' => 'Ingresar a Usuarios CRUD',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CLIENTE CRUD */
            'name' => 'Cliente_Index',
            'area' => 'Administracion',
            'descripcion' => 'Ingresar a Cliente CRUD',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A PROCEDENCIA CRUD */
            'name' => 'Procedencia_Index',
            'area' => 'Administracion',
            'descripcion' => 'Ingresar a Procedencia Clientes CRUD',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A EMPRESA CRUD */
            'name' => 'Empresa_Index',
            'area' => 'Administracion',
            'descripcion' => 'Ingresar a Empresa (Compañía) CRUD',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A SUCURSAL CRUD */
            'name' => 'Sucursal_Index',
            'area' => 'Administracion',
            'descripcion' => 'Ingresar a Sucursal CRUD',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CAJA CRUD */
            'name' => 'Caja_Index',
            'area' => 'Ventas Supervisor',
            'descripcion' => 'Ingresar a Caja CRUD',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CARTERA CRUD */
            'name' => 'Cartera_Index',
            'area' => 'Ventas Supervisor',
            'descripcion' => 'Ingresar a Cartera CRUD',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A CORTE DE CAJA */
            'name' => 'Corte_Caja_Index',
            'area' => 'Ventas Cajero',
            'descripcion' => 'Ingresar a Corte de Caja',
            'guard_name' => 'web'
        ]);



    





        /* VENTAS */
        Permission::create([    /* INGRESAR A CATEGORIA CRUD */
            'name' => 'Category_Index',
            'area' => 'Inventarios',
            'descripcion' => '',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A PRODUCTOS CRUD */
            'name' => 'Product_Index',
            'area' => 'Inventarios',
            'descripcion' => '',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A COINS CRUD */
            'name' => 'Coins_Index',
            'area' => 'Ventas Supervisor',
            'descripcion' => 'Crear Monedas para las Ventas',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A VENTAS */
            'name' => 'Sales_Index',
            'area' => 'Ventas Cajero',
            'descripcion' => 'Poder ver la Sección de Nueva Venta',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A ARQUEOS VENTAS */
            'name' => 'Cashout_Index',
            'area' => 'Ventas Supervisor',
            'descripcion' => 'Ingresar a Arqueos Ventas',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* INGRESAR A REPORTES VENTAS */
            'name' => 'Reportes_Index',
            'area' => 'Ventas Supervisor',
            'descripcion' => 'Ingresar a Reportes Ventas',
            'guard_name' => 'web'
        ]);
        Permission::create([    /* PERMITIR SACAR PDF REPORTE DE VENTAS */
            'name' => 'Report_Sales_Export',
            'area' => 'Ventas Supervisor',
            'descripcion' => 'Permitir sacar Pdf Reporte de Ventas',
            'guard_name' => 'web'
        ]);

        /* SIDEBAR */
        Permission::create([    /* PERMITIR VER TIGO MONEY EN EL SIDEBAR */
            'name' => 'Ver_TigoMoney_SideBar',
            'area' => 'Tigo Money',
            'descripcion' => '',
            'guard_name' => 'web'
        ]);

        // Inventarios


        Permission::create([
            'name' => 'Inventarios_Registros',
            'area' => 'Inventarios',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
        Permission::create([
            'name' => 'Compras_Index',
            'area' => 'Inventarios',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
        Permission::create([
            'name' => 'Almacen_Index',
            'area' => 'Inventarios',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
        Permission::create([
            'name' => 'Transferencia_Index',
            'area' => 'Inventarios',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
        Permission::create([
            'name' => 'Reportes_Inventarios_Export',
            'area' => 'Inventarios',
            'descripcion' => '',
            'guard_name' =>'web'
        ]);
    }
}
