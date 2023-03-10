<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'guard_name','areaspermissions_id','descripcion'];

    //relacion que tiene con categoria y tambien para usarlo en el component 
    public function areaspermissions()
    {
        return $this->belongsTo(Areaspermissions::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_has_permissions', 'permission_id', 'role_id');
    }
}
