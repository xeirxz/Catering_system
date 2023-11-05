<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $table = 'packages';
    protected $fillable = ['price_id', 'menu', 'menu_image', 'variant_id','max_options'];

    public function price()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }

    public function variant()
    {
        return $this->belongsTo(Variants::class, 'variant_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'package_id');
    }
}
