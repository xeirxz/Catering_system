<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;


    protected $table = 'bookings';
    protected $fillable = ['user_id', 'price_id', 'package_id', 'status', 'date', 'time', 'payment_method'];


    protected $casts = [
        'package_id' => 'array',
    ];



    public function users()
    {
        return $this->belongsTo(User::class,  'user_id');
    }


    public function price()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }


    public function packages()
    {
        return $this->hasMany(Packages::class, 'id', 'package_id');
    }
}
