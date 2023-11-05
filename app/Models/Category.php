<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'description'];

    public function packages()
    {
        return $this->hasMany(Packages::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
