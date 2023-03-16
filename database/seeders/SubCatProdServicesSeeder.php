<?php

namespace Database\Seeders;

use App\Models\SubCatProdService;
use Illuminate\Database\Seeder;

class SubCatProdServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCatProdService::create([
            'name' => 'LG',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '1',
        ]);
        SubCatProdService::create([
            'name' => 'Hp',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '2',
        ]);
        SubCatProdService::create([
            'name' => 'Asus',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '2',
        ]);
        SubCatProdService::create([
            'name' => 'Acer',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '2',
        ]);
        SubCatProdService::create([
            'name' => 'Dell',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '2',
        ]);
        SubCatProdService::create([
            'name' => 'Lenovo',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '2',
        ]);
        SubCatProdService::create([
            'name' => 'Samsung',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '3',
        ]);
        SubCatProdService::create([
            'name' => 'Apple',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '7',
        ]);
        SubCatProdService::create([
            'name' => 'Realme',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '7',
        ]);
        SubCatProdService::create([
            'name' => 'Poco',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '7',
        ]);
        SubCatProdService::create([
            'name' => 'OnePlus',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '7',
        ]);
        SubCatProdService::create([
            'name' => 'Xiaomi',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '7',
        ]);
        SubCatProdService::create([
            'name' => 'TecnoSpark',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '7',
        ]);
        SubCatProdService::create([
            'name' => 'Nokia',
            'price' => '30',
            'status' => 'Active',
            'cat_prod_service_id' => '7',
        ]);
    }
}
