<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Especifica la tabla si es diferente al nombre del modelo en plural
    protected $table = 'categories';

    // Define los campos que son asignables en masa
    protected $fillable = [
        'name',
        'description',
        'deleted',
    ];

    // Si necesitas definir alguna relación, por ejemplo, con eventos
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}

