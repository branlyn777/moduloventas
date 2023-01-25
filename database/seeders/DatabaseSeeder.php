<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Product;
use App\Models\ProductosDestino;
use Facade\FlareClient\Http\Client;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ModelHasRolesSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(AreaspermissionsSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleHasPermissionSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(SucursalUserSeeder::class);
        // $this->call(DestinoSeeder::class);
        $this->call(DenominationSeeder::class);
        $this->call(CajaSeeder::class);
        $this->call(CarteraSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(ProductoDestinoSeeder::class);
        $this->call(CarteraMovCategoriaSeeder::class);
        $this->call(ProcedenciaClienteSeeder::class);



        //Factories
       // Product::factory(10)->create();
        // ProductosDestino::factory(10)->create()->each(function ($productodestino) {
        //     $productodestino->ingresoproductos()->create([
        //         'destino' => 1,
        //         'user_id' => 1,
        //         'concepto' => 'INGRESO',
        //         'observacion' => 'INGRESO'
        //     ]);
        // });
        //$this->call(ProductoDestino2Seeder::class);
        // Cliente::factory(1000)->create();
    }
}
