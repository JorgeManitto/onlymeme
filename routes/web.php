<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'dashboard'])->name("dashboard");
Route::get('/{slug}', [DashboardController::class, 'category'])->name("category");
Route::get('/tags/{text}', [DashboardController::class, 'tags'])->name("tags");
Route::get('/post/{slug}',[DashboardController::class,'post'])->name('post.view');

Route::post('/addreaction',[DashboardController::class,'AddReaction'])->name('post.addreaction');
Route::post('/removereaction',[DashboardController::class,'RemoveReaction'])->name('post.removereaction');

Route::post('add-post',[PostController::class,'add_post'])->name('post.add_post');

Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');
Route::post('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('/profile/{id}',[ProfileController::class,'profile'])->name('profile');
Route::get('/profile/edit/{id}',[ProfileController::class,'edit_profile'])->name('edit_profile');
Route::post('/profile/update_profile',[ProfileController::class,'update_profile'])->name('profile.update_profile');

Route::get('/test',[PostController::class,'test'])->name('post.test');
