<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('83jm0jd16vzl@8a0nzr', static function(Request $request){

    $method = $request->input('method') ?? 'getMe';
    $parameters = $request->input('parameters') ?? [];

    try {
        $telegramRequest = Http::timeout(20)
            ->post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/' . $method , $parameters);

        if($telegramRequest->failed()) {
            return response()->json([
                'success' => false,
                'message' => $telegramRequest->reason()
            ]);
        }

        return $telegramRequest->json();
    } catch (Exception $exception) {
        return response()->json([
            'success' => false,
            'message' => $exception->getMessage()
        ]);
    }
});
