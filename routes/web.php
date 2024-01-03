<?php

// use App\Http\Controllers\AlbumController;
// use App\Http\Controllers\ArtistController;
// use App\Http\Controllers\TrackController;

use App\Http\Controllers\MailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
DB::connection()->enableQueryLog();
Route::get('/', function () {
    return view('welcome');
});

// Route::get('sendbasicemail',[MailController::class,'basic_email']);
// Route::get('sendhtmlemail',[MailController::class,'html_email']);
// Route::get('sendattachmentemail',[MailController::class,'attachment_email']);


// Route::resource('view/album/{action?}', AlbumController::class)->only(['index', 'create', 'showOne'])->whereIn('action',['create','update','delete']);

// Route::prefix('api/chinook')->group(function () {
//     Route::put('album', [AlbumController::class,'api_updateOne']);
//     Route::get('album/{id?}', [AlbumController::class,'api_getdetail']);
//     Route::post('album', [AlbumController::class,'api_post']);
// });
// Route::prefix('view')->group(function () {
//     Route::get('album/find', [AlbumController::class,'search']);
//     Route::get('album/sort', [AlbumController::class,'sort']);
//     Route::get('album/{action?}/{id?}', [AlbumController::class,'index']);
// });

// Route::prefix('api/chinook')->group(function () {
//     Route::put('artist', [ArtistController::class,'api_updateOne']);
//     Route::get('artist/{id?}', [ArtistController::class,'api_getdetail']);
//     Route::post('artist', [ArtistController::class,'api_post']);
// });
// Route::prefix('view')->group(function () {
//     Route::get('artist/find', [ArtistController::class,'search']);
//     Route::get('artist/sort', [ArtistController::class,'sort']);
//     Route::get('artist/{action?}/{id?}', [ArtistController::class,'index']);
// });

// Route::prefix('api/chinook')->group(function () {
//     Route::put('track', [TrackController::class,'api_updateOne']);
//     Route::get('track/{id?}', [TrackController::class,'api_getdetail']);
//     Route::post('track', [TrackController::class,'api_post']);
// });
// Route::prefix('view')->group(function () {
//     Route::get('track/find', [TrackController::class,'search']);
//     Route::get('track/sort', [TrackController::class,'sort']);
//     Route::get('track/{action?}/{id?}', [TrackController::class,'index']);
// });

// Route::prefix('api/portofolio')->group(function(){
//     Route::get('products/{id?}', [ProductController::class, 'show']);
// });
// Route::prefix('api')->group(function(){
//     Route::post('products', [ProductController::class, 'store']);
//     Route::get('products/{id?}', [ProductController::class, 'show']);
//     Route::get('products', [ProductController::class, 'index']);
// });

Route::prefix('api')->group(function(){
    Route::get('products/testing',[ProductController::class,'testing']);
    Route::post('myauth/login', [UserController::class,'login']);
    Route::post('myauth/register', [UserController::class,'registration']);
    Route::post('user/profile', [UserController::class,'profile']);
});
// valid request list
//index (get), store (post), show (get/{id}), update (put/patch), destroy (delete)
Route::apiResources([
    'api/products'=> ProductController::class,
    
]);
Route::view('/{react?}', 'welcome')->where('path', '/');
// Route::view('/{react?}', 'welcome')->where('path', '/sign-in');
// Route::view('/{react?}', 'welcome')->where('path', '/dashboard');
// Route::view('/{react?}', 'welcome')->where('path', '/register');
// Route::view('/{react?}', 'welcome')->where('path', '/');

//index, create (*/create), store, show, edit (*/{id?}/edit), update, destroy
// Route::resource('api/products', ProductController::class);