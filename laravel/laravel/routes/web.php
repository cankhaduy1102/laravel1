<?php
use App\Product;
use App\Category;
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
    $categories=Category::all();
    $cate_1=Category::paginate(4);
    $product=Product::paginate(8);
    return view('welcome',[
        'cate'=>$categories,
        'product'=>$product,
        'cate1'=>$cate_1
    ]);
})->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//

Route::get('blog','HomeController@blog')->name('blog');
Route::get('blog-details','HomeController@blogDetail')->name('blog.detail');
Route::get('checkout','HomeController@checkout')->name('checkout');
Route::get('contact','HomeController@contact')->name('contact');
Route::get('main','HomeController@main')->name('main');
Route::get('shop-details','HomeController@shopDetail')->name('shop.detail');
Route::get('shop-gird','HomeController@shopGird')->name('shop.gird');
Route::get('shopping-cart','HomeController@shoppingCart')->name('shopping.cart');
Route::get('product/add-cart/{id}','HomeController@addToCart')->name('add.cart');
Route::get('remove', 'HomeController@remove')->name('cart.delete');
Route::get('product/update', 'HomeController@update')->name('cart.update');
Route::get('product/whish-list/{id}', 'HomeController@whishList')->name('wish.list');


Route::get('layout',function(){
    return view('layout.main');
});
Route::get('login','loginController@loginForm')->name('login');
Route::get('logout','loginController@logout')->name('logout');
Route::get('/search', 'HomeController@search');
