<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    protected $table = 'variants';
    protected $fillable = ['variant_name'];

    public function packages()
    {
        return $this->hasMany(Packages::class);
    }
}
