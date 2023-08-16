<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use MailchimpMarketing\ApiClient;

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





Route::get('/', [PostController::class ,'search']);
Route::get('/post/{post:slug}', [PostController::class ,'show']);

Route::get("/register", [RegisterController::class , 'show'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::post('/comment', [CommentController::class, 'comment'])->middleware('auth');
Route::post('/post', [PostController::class, 'post'])->middleware('auth');

Route::get('/myPosts', [PostController::class, 'myPosts'])->middleware('auth');

Route::post('/reply', [ReplyController::class, 'create'])->middleware('auth');





Route::post('/newsletter',  function (){
    request()->validate(['email'=>'required|email']);
    $client = new MailchimpMarketing\ApiClient();
    $client->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us12'
    ]);
    try {
        $response = $client->lists->addListMember("25a6d68447", [
            "email_address" => request('email'),
            "status" => "subscribed",
        ]);
    }catch (\Exception $e){
        return redirect()->back()->with(['message'=>"E-mail Doesn't exist"]);
    }
    return redirect()->back()->with(['message'=>'Your E-mail has been registered!']);
});
