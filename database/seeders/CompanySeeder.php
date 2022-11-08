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
            'name' => 'Tu Empresa',
            'shortname' => 'Mi Empresa',
            'adress' => 'Avenida América casi esquina G René Moreno',
            'phone' => '4240013',
            'nit_id' => '965645',
            'image' => 'logo_company.png'
        ]);
    }
}
