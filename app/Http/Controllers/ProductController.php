<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function create()
    {
        // SESUAI MODUL HALAMAN 2
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('products.create');
    }
    
    // Method lainnya...
}