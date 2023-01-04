<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    // protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // $costo = $this->faker->numberBetween(10,999);
        // $utilidad = 10;
        // $precio = $costo + $utilidad;



        // return [
        //     'nombre' => $this->faker->name(),
        //     'costo' => $costo,
        //     'caracteristicas' => $this->faker->randomElement(['Nuevo','Usado','SemiNuevo']),
        //     'codigo' => $this->faker->numberBetween(100000,999999),
        //     'lote' => $this->faker->numberBetween(100,999),
        //     'unidad' => $this->faker->randomElement(['Pieza','Kg','Ltrs']),
        //     'marca' => $this->faker->randomElement(['Samsung','Lg','Xiaomi','Apple','Huawei']),
        //     'garantia' => $this->faker->randomElement([2,5,10,20]),
        //     'cantidad_minima' => $this->faker->randomElement([2,5,10]),
        //     'industria' => $this->faker->randomElement(['China','EEUU','Alemana','Japonesa']),
        //     'precio_venta' => $precio,
        //     'status' => 'ACTIVO',
        //     'control' => $this->faker->randomElement(['AUTOMATICO','MANUAL']),
        //     'category_id' => Category::all()->numberBetween()->id,
        //     'control' => $this->faker->randomElement(['AUTOMATICO','MANUAL']),
        // ];

        $costo = $this->faker->biasedNumberBetween(10,999);
        $utilidad = $this->faker->biasedNumberBetween(1,100);
        $precio = $costo + $utilidad;



        return [
            'nombre' => $this->faker->name(),
            'costo' => $costo,
            'caracteristicas' => $this->faker->randomElement(['Nuevo','Usado','SemiNuevo']),
            'codigo' => $this->faker->ean8(),
            'lote' => $this->faker->isbn10(),
            'unidad' => $this->faker->randomElement(['Pieza','Kg','Ltrs']),
            'marca' => $this->faker->randomElement(['Samsung','Lg','Xiaomi','Apple','Huawei']),
            'garantia' => $this->faker->randomElement([2,5,10,20]),
            'cantidad_minima' => $this->faker->randomElement([2,5,10]),
            'industria' => $this->faker->randomElement(['China','EEUU','Alemana','Japonesa']),
            'precio_venta' => $precio,
            'status' => 'ACTIVO',
            'control' => $this->faker->randomElement(['AUTOMATICO','MANUAL']),
            'category_id' => rand(1,Category::all()->count()),
            'control' => $this->faker->randomElement(['AUTOMATICO','MANUAL']),
        ];
    }
}
