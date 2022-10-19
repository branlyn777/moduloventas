<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Nombre de la Empresa',
            'shortname' => 'Nombre Corto',
            'adress' => 'Av. XXXXX Casi XXXXXXX',
            'phone' => '4400000',
            'nit_id' => '965645',
            'image' => 'logo_company.png'
        ]);
    }
}
