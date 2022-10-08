<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Services\CurrencyQuoteService;
use App\Services\AwesomeapiService;
use App\Services\HgbrasilService;
use App\Services\BcbService;
use App\Objects\CurrencyQuoteObject;

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
        $API = new AwesomeapiService(new Client);
        // $API = new BcbService(new Client);
        // $API = new HgbrasilService(new Client);
        $CurrencyQuote = new CurrencyQuoteObject();
        $CurrencyQuote->setCode("USD");
        $CoinPrice = new CurrencyQuoteService($API, $CurrencyQuote);
        
        
        echo '<pre>';
        print_r($CoinPrice->getPrice());
        echo '</pre>';
    }
);