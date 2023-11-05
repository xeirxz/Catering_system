<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function customerOrder() {


        $byCategory = DB::table('categories')
        ->select('id', 'name')
        ->get();

        $byPrice = DB::table('prices')
        ->select('id', 'price', 'category_id')
        ->get();

        $dataPack = DB::table('packages')
        ->select('id', 'menu','variant', 'price_id')
        ->get();

        return view('customer.orders.customers_oder', compact('byCategory', 'byPrice', 'dataPack'));
    }
}
