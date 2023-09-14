<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::with(['user', 'book'])->get();
        return view('admin.sale.index', compact('sales'));
    }
}
