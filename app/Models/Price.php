<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $table = 'prices';
    protected $fillable = ['category_id', 'price', 'price_name', 'price_description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function packages()
    {
        return $this->hasMany(Packages::class, 'price_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'price_id');
    }
}
