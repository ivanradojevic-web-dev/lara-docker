<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/home', function () {
    $searchQuery = request('search') ?? '';

    $artists = Http::get('https://itunes.apple.com/search', [
        'term' => $searchQuery,
        'entity' => 'musicArtist',
        'limit' => 10,
    ])->json()['results'] ?? [];

    $songs = Http::get('https://itunes.apple.com/search', [
        'term' => $searchQuery,
        'entity' => 'song',
        'limit' => 10,
    ])->json()['results'] ?? [];

    $albums = Http::get('https://itunes.apple.com/search', [
        'term' => $searchQuery,
        'entity' => 'album',
        'limit' => 10,
    ])->json()['results'] ?? [];

    $videos = Http::get('https://itunes.apple.com/search', [
        'term' => $searchQuery,
        'entity' => 'musicVideo',
        'limit' => 10,
    ])->json()['results'] ?? [];

    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'artists' => $artists,
        'songs' => $songs,
        'albums' => $albums,
        'videos' => $videos,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
