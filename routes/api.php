<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Services\Coin\CurrencyQuoteService;
use App\Services\Coin\AwesomeapiService;
use App\Services\Coin\HgbrasilService;
use App\Services\Coin\BcbService;
use App\Objects\Coin\CurrencyQuoteObject;

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

Route::get('/coin/{code}',
    function (Request $request, $code)
    {

        $API = new AwesomeapiService(new Client);
        // $API = new HgbrasilService(new Client);
        // $API = new BcbService(new Client);

        $CurrencyQuote = new CurrencyQuoteObject();
        $CurrencyQuote->setCode($code);
 
        $CoinPrice = new CurrencyQuoteService($API, $CurrencyQuote);

        echo '<pre>';
        print_r($CoinPrice->getPrice());
        echo '</pre>';
    }
);