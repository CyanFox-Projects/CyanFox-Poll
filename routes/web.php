<?php

use App\Livewire\Home;
use App\Livewire\Impress;
use App\Livewire\Polls\AdminDashboard;
use App\Livewire\Polls\CreatePoll;
use App\Livewire\Polls\FindPoll;
use App\Livewire\Polls\Vote;
use App\Livewire\Privacy;
use Filament\Notifications\Notification;
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

Route::get('/', Home::class)->middleware('lang')->name('home');

Route::group(['prefix' => 'polls', 'as' => 'polls.', 'middleware' => 'lang'], function () {
    Route::get('create', CreatePoll::class)->name('create');
    Route::get('find', FindPoll::class)->name('find');
    Route::get('view/{viewSecret}', Vote::class)->name('view');
    Route::get('admin/{adminSecret}', AdminDashboard::class)->name('admin');
});

if (config('legal.impress') !== null) {
    Route::get('impress', Impress::class)->name('impress');
}

if (config('legal.privacy') !== null) {
    Route::get('privacy', Privacy::class)->name('privacy');
}

Route::prefix('lang')->group(function () {
    Route::get('de', function () {
        cookie()->queue(cookie()->forget('language'));
        cookie()->queue(cookie()->forever('language', 'de'));

        Notification::make()
            ->title(__('messages.notifications.language_updated'))
            ->success()
            ->send();

        return redirect()->back();
    })->name('lang.de');

    Route::get('en', function () {
        cookie()->queue(cookie()->forget('language'));
        cookie()->queue(cookie()->forever('language', 'en'));

        Notification::make()
            ->title(__('messages.notifications.language_updated'))
            ->success()
            ->send();

        return redirect()->back();
    })->name('lang.en');
});

Route::get('errors/{errorCode}', function () {
    if (request()->errorCode < 400 || request()->errorCode > 599) {
        abort(400);
    }

    abort(request()->errorCode);
});
