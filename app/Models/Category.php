<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'descripcion','categoria_padre','status'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories(){
      return Category::where('categoria_padre',$this->id)
        ->count();
    }
    public function detsub(){
      return Category::where('categoria_padre',$this->id)->get();
    }
    public function getImagenAttribute()
    {
        if ($this->image == null) {
            return 'noimage.jpg';
        }
        if (file_exists('storage/categorias/' . $this->image))
            return $this->image;
        else {
            return 'noimage.jpg';
        }
    }

    public function subcat(){
        return $this->belongsTo(Category::class, 'categoria_padre', 'id');
    }
}
