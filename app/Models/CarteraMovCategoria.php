<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteraMovCategoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','detalle','tipo','subcategoria','status'];
}
