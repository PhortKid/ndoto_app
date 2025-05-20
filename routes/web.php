<?php
use App\Models\Wallet;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemsController;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use App\Http\Controllers\Profile;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PurchaseController;


Route::view('/', 'welcome');

Route::get('logout', function () {
    Auth::logout();  // Logs out the current user
    return redirect('/');  // Redirects to the home page after logging out
})->name('logout');

Route::resource('wallet', WalletController::class);
Route::resource('withdraw', WithdrawController::class);


Route::view('wallet','dashboard.wallet');
Route::view('withdraw','dashboard.withdraw');




    Route::get('dashboard', function (){
        return redirect()->route('workspace.index');
    })->name('dashboard');



Route::get('/profile', [Profile::class, 'index'])->middleware(['auth'])->name('profile.index');
Route::put('/profile/{profile}', [Profile::class, 'update'])->middleware(['auth'])->name('profile.update');




Route::resource('workspace',App\Http\Controllers\DashboardController::class)->middleware(['auth']);
Route::resource('workspace_items',App\Http\Controllers\ItemsController::class)->middleware(['auth']);

Route::get('pay',[App\Http\Controllers\PaymentController::class,'pay']);
Route::get('verify',[App\Http\Controllers\PaymentController::class,'verify']);

Route::get('create_wallet',
function (){
 

    Wallet::create(['user_id'=>'1']);
}
);

Route::get('truncate_wallet',
function (){
 
    Wallet::where('user_id', 1)->update(['balance' => 0]);
   // Wallet::truncate();
}
);

Route::get('/{username}', function ($username) {
    // Retrieve the user based on the username
    $user = User::where('name', $username)->first();

    if (!$user) {
       // return redirect()->route('home')->with('error', 'User not found');
    return 'user not found';
    }
    $items = Item::where('user_id', $user->id)->get();
    return view('page', compact('user', 'items'));
});

// Purchase routes
Route::get('/purchase/{item}', [PurchaseController::class, 'show'])->name('purchase.show');
Route::post('/purchase/{item}', [PurchaseController::class, 'store'])->name('purchase.store');

require __DIR__.'/auth.php';
