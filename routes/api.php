<?php

use App\Governorate;
use App\Http\Controllers\api\unAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\api\ApidetProducController;
use App\Http\Controllers\api\ApiProductsController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//welcome
Route::get('lang', 'api\ApiHomeController@lang');
Route::get('welcome', 'api\ApiHomeController@showDivision');
Route::get('home', 'api\ApiHomeController@home');
Route::post('edit-profile', 'api\ApiHomeController@editprofile')->middleware('CustomerAuth');
Route::post('edit-profile-password', 'api\ApiHomeController@editprofilepassword')->middleware('CustomerAuth');
Route::get('about-us', 'api\ApiHomeController@about');
Route::get('terms-an-conditions', 'api\ApiHomeController@terms');

Route::get('governorates', function () {
    return response()->json([
        'status' => 200,
        'message' => 'latest_products',
        'data' => Governorate::get(),
    ], 200);

});

Route::get('profile', 'api\ApiHomeController@profileinf')->middleware('CustomerAuth');
Route::post('add-contuct-us', 'api\ApiHomeController@contuctus');
Route::get('search', 'api\ApiProductsController@search');

//login & register
Route::post('register-Verify-Send-Code', 'api\ApiauthController@Register');
Route::post('register-Verify-enter-Code', 'api\ApiauthController@RegisterCode');
Route::post('register-info', 'api\ApiauthController@Registerinfo');
Route::post('login', 'api\ApiauthController@login');
Route::post('Verify-password', 'api\ApiauthController@Verifypassword');
Route::post('change-password', 'api\ApiauthController@newpassword');
Route::post('forget-password-rest', 'api\ApiauthController@forgetPassword');
Route::post('social-media-auth', 'api\ApiauthController@socialMediaAuth');

//products
Route::get('section', 'api\ApiProductsController@section');
Route::get('best-seller', 'api\ApiProductsController@bestseller');

Route::get('get-categories-products', 'api\ApiProductsController@categoriesProducts');

Route::get('latest-products', [ApiProductsController::class, 'latest']);

Route::get('filter-products', [ApiProductsController::class, 'filter']);

//Route::get('detials-product',[ApidetProducController::class,'detialsprod']);
Route::get('detials-product', 'api\ApidetProducController@detialsprod');

Route::post('add-comment', 'api\ApidetProducController@addcomment');
Route::post('add-favourites', 'api\ApidetProducController@addfav')->middleware('CustomerAuth');
Route::get('favourites', 'api\ApiProductsController@favourites')->middleware('CustomerAuth');
Route::post('add-produt', 'api\ApidetProducController@order');

Route::get('data/get-product-detials', [ApidetProducController::class, 'dataproductinarray']);

Route::get('cart', 'api\ApidetProducController@cart');

Route::post('count-cart', 'api\ApidetProducController@countcart');

#Delete From Cart
Route::post('delete-carts', 'api\ApidetProducController@Deleteorder');
Route::post('delete-cart-item', [ApidetProducController::class, 'deleteItemFromCart']);

Route::post('detials-carts', 'api\ApidetProducController@cartdetial')->middleware('CustomerAuth');
Route::post('finish-order', 'api\ApidetProducController@addorder')->middleware('CustomerAuth');
Route::get('my-orders', 'api\ApidetProducController@myorders')->middleware('CustomerAuth');
Route::get('detials-order', 'api\ApidetProducController@detialsorder')->middleware('CustomerAuth');
Route::get('titles-order', 'api\ApidetProducController@titleorder')->middleware('CustomerAuth');
Route::post('Delete-title', 'api\ApidetProducController@Deletetitle');


Route::post('unAuth/order', [unAuthController::class, 'APIstore']);

//  $list['Carts'][$key]['cart_id'] = $val->id;

// governorate_id