<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Validators\Failure;

class ProductsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, WithCalculatedFormulas
{
    private $categories;

    public function __construct()
    {
        $this->categories = Category::pluck('id', 'name');
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $product = new Product();
        $product->nombre = preg_replace('/\s+/', ' ', trim($row['nombre']));
        // $product->costo = preg_replace('/\s+/', ' ',trim($row['costo']));
        // $product->precio_venta = preg_replace('/\s+/', ' ',trim($row['precio']));
        $product->caracteristicas = preg_replace('/\s+/', ' ', trim($row['caracteristicas'] ?? 's/c'));
        $product->codigo = preg_replace('/\s+/', ' ', trim($row['codigo']));
        // $product->lote = preg_replace('/\s+/', ' ',trim($row['lote']));
        $product->lote = 0;
        $product->unidad = preg_replace('/\s+/', ' ', trim($row['unidad'] ?? 's/u'));
        $product->marca = preg_replace('/\s+/', ' ', trim($row['marca'] ?? 's/m'));
        $product->garantia = preg_replace('/\s+/', ' ', trim($row['garantia'] ?? 0));
        $product->cantidad_minima = preg_replace('/\s+/', ' ', trim($row['cantidad_minima'] ?? 0));
        $product->industria = preg_replace('/\s+/', ' ', trim($row['industria'] ?? 's/i'));
        // $product->precio_venta = preg_replace('/\s+/', ' ',trim($row['precio']));
        $product->status = preg_replace('/\s+/', ' ', trim($row['status'] ?? 'ACTIVO'));
        if ($row['categoria'] == null) {
            $product->category_id = $this->categories['NO DEFINIDO'];
        } else {
            $auxi = Category::where('name', strtoupper($row['categoria']))->get();
            if (count($auxi) == 0) {
                // dd("no esta nulo");
                $fg = Category::create([
                    'name' => strtoupper($row['categoria']),
                    'descripcion' => 'ninguna'
                ]);

                $product->category_id = $fg->id;
                $fg->save();
                $this->categories = Category::pluck('id', 'name');
            } else {

                $product->category_id = $this->categories[strtoupper($row['categoria'])];
            }
        }

        if ($row['subcategoria'] == null) {
        } else {
            $auxi = Category::where('name', strtoupper($row['subcategoria']))->get();

            if (count($auxi) == 0) {
                // dd("no esta nulo");
                $fg = Category::create([
                    'name' => strtoupper($row['subcategoria']),
                    'descripcion' => 'ninguna',
                    'categoria_padre' => $this->categories[strtoupper($row['categoria'])]
                ]);

                $product->category_id = $fg->id;
            } else {

                $this->categories = Category::pluck('id', 'name');
                $cat = $this->categories[strtoupper($row['categoria'])];
                $subcat = Category::where('name', strtoupper($row['subcategoria']))->select('categories.categoria_padre')->value('categoria_padre');

                if ($subcat !== $cat) {
                    $error = ['Error en la columna subcategoria, una subcategoria no pertenece a la categoria del producto que se quiere registrar, revise su archivo por favor'];
                    $failures[] = new Failure(13, 'subcategoria', $error, $row);
                    throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
                }


                $product->category_id = $this->categories[strtoupper($row['subcategoria'])];
            }
        }

        $product->save();
    }
    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }

    public function rules(): array
    {
        return [             // Above is alias for as it always validates in batches
            '*.nombre' => [
                'distinct', 'required', 'unique:products',

            ],
            '*.codigo' => [
                'distinct', 'required', 'unique:products'
            ],
            // '*.costo' =>[
            //     'numeric','required'
            // ],
            // '*.precio_venta' =>[
            //     'numeric','required'
            // ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nombre.unique' => 'El nombre del producto ya existe, revise su archivo por favor, campo :attribute',
            'nombre.distinct' => 'Nombres duplicados del producto',
            'codigo.unique' => 'El codigo ya existe',
            'codigo.distinct' => 'Tiene codigos duplicados, revise su archivo',
        ];
    }
}
