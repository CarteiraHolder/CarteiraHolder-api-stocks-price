<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Services\CoinPriceService;
use App\Services\AwesomeapiService;
use App\Objects\CoinObject;

use GuzzleHttp\Client;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teste',
    function (Request $request)
    {
        $AwesomeapiService = new AwesomeapiService(new Client);
        $Coin = new CoinObject();
        $CoinPrice = new CoinPriceService($AwesomeapiService, $Coin);
        
        
        echo '<pre>';
        print_r($CoinPrice->getPrice());
        echo '</pre>';
    }
);