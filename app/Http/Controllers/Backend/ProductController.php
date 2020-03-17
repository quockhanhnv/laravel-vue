<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    	$products = [
    		['name' => 'Asus K43S'],
    		['name' => 'Iphone 11'],
    		['name' => 'Iphone 12'],
    		['name' => 'Iphone 9'],
    	];

    	return view('backend.products.index', [
    		'products' => $products
    	]);
    }
}
