<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Laravel Class';
});

Route::get('category/{categoryId}/post/{postId}', function($categoryId, $postId) {
    return "Category: $categoryId <br/>Bai viet: $postId";
})->where('categoryId', '[0-9]+');


Route::get('register', function() {
    return view('register');
})->name('register');

Route::post('user/{id}', function($id) {
    return 'User ID: ' . $id;
});

Route::get('product', function() {
    return view('product');
});

Route::delete('delete/product/{id}', function($id) {
    return 'Deleted product ' . $id;
});

Route::options('test-option', function() {
    return 'Test option';
});

Route::patch('test-patch', function() {
    return 'Test PATCH ROUTE';
});

Route::match(['get', 'post'], 'profile', function() {
    return 'Profile infomation';
});

// Route::get('product/{id}', function($id) {
//     return 'Product ID: ' . $id;
// })->name('product.detail');

Route::get('category/{cateId}/product/{productId}', function($cateId, $productId) {
    return 'Category ID: ' . $cateId . '<br/>Product ID: ' . $productId;
})->name('product.category');


// Backend
Route::namespace('Backend')
    ->prefix('backend')->middleware('verify.user')->group(function() {
    
    Route::get('/', 'DashboardController@index')->name('backend.dashboard.index');
    Route::get('product', 'ProductController@index')->name('backend.product.index');;
    Route::get('category', 'CategoryController@index')->name('backend.category.index');;
    Route::get('news', 'NewsController@index')->name('backend.news.index');;
    Route::get('user', 'UserController@index')->name('backend.user.index');;
});
