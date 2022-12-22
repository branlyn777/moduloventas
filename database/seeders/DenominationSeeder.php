<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Denomination;
class DenominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Denomination::create([
            'type'=>'BILLETE',
            'value'=>'200',
            'image'=>'200.jpg'        
        ]);
        Denomination::create([
            'type'=>'BILLETE',
            'value'=>'100',
            'image'=>'100.jpg'           
        ]);
        Denomination::create([
            'type'=>'BILLETE',
            'value'=>'50',
            'image'=>'50.jpg'     
        ]);
        Denomination::create([
            'type'=>'BILLETE',
            'value'=>'20',
            'image'=>'20.jpg'            
        ]);
        Denomination::create([
            'type'=>'BILLETE',
            'value'=>'10',
            'image'=>'10.jpg'            
        ]);
        Denomination::create([
            'type'=>'MONEDA',
            'value'=>'5',
            'image'=>'5.jpg'            
        ]);
        Denomination::create([
            'type'=>'MONEDA',
            'value'=>'2',
            'image'=>'2.jpg'            
        ]);
        Denomination::create([
            'type'=>'MONEDA',
            'value'=>'1',
            'image'=>'1.jpg'            
        ]);
        Denomination::create([
            'type'=>'MONEDA',
            'value'=>'0.50',
            'image'=>'0,50.jpg'            
        ]);
        Denomination::create([
            'type'=>'MONEDA',
            'value'=>'0.20',
            'image'=>'0,20.jpg'            
        ]);
        Denomination::create([
            'type'=>'MONEDA',
            'value'=>'0.10',
            'image'=>'0,10.jpg'            
        ]);
        Denomination::create([
            'type'=>'OTRO',
            'value'=>'0',
            'image'=>'otro.jpg'           
        ]);
    }
}
