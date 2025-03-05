<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CardController;


Route::post('register', [AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('/forgot-password', function (Request $request){
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::RESET_LINK_SENT
                ? response()->json(['status' => __($status)]) : response()->json(['email' => __($status)], 400);
})->name('password.email');

Route::post('/reset-password', function (Request $request){
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed'
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
                ? response()->json(['status' => __($status)])
                : response()->json(['email' => [__($status)]], 400);

})->name('password.update');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/checkingAuthenticated',function (){
        return response()->json(['message' => 'Vous avez', 'status' => 200],200);
    });
   Route::post('logout', [AuthController::class,'logout']);

    Route::post('cartes', [CardController::class, 'store'])->middleware('cors');
    Route::get('cartes', [CardController::class, 'index'])->middleware('cors');
    Route::get('cartesAll',[CardController::class, 'all'])->middleware('cors');
    Route::delete('/cartes/{id}', [CardController::class, 'destroy'])->name('cartes.destroy')->middleware('cors');
    //Route::get('cartes', [CardController::class, 'index'])->middleware('cors');
    Route::get('cartes/{id}', [CardController::class, 'show'])->name('cartes.show')->middleware('cors');
    Route::post('/cartes/{carte}', [CardController::class, 'update'])->name('cartes.update')->middleware('cors');
    Route::get('/cartes/{id}/print', [CardController::class, 'print'])->middleware('cors');
});
