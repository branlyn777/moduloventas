<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeWork extends Model
{
    use HasFactory;

    protected $fillable = ['name','status'];

    public function servicios()
    {
        return $this->hasMany(Service::class);
    }
}

