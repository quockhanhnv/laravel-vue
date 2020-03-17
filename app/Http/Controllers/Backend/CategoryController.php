<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories = [
    		['name' => 'Laptop'],
    		['name' => 'Desktop'],
    		['name' => 'Mobile'],
    		['name' => 'Tablet'],
    	];

    	return view('backend.categories.index', [
    		'categories' => $categories
    	]);
    }
}
