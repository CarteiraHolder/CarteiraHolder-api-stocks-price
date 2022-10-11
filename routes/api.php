<?php

use App\Objects\Coin\CoinObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Services\Coin\CurrencyQuoteService;
use App\Services\Coin\AwesomeapiService;
use App\Services\Coin\HgbrasilService;
use App\Services\Coin\BcbService;
use App\Objects\Coin\CurrencyQuoteCoinObject;

use App\Objects\Cripto\CriptoObject;
use App\Services\Cripto\AlphavantageService;
use App\Services\Cripto\MercadobitcoinService;
use App\Services\Cripto\CoinmarketcapService;
use App\Services\Cripto\YahoofinanceService;
use App\Services\Cripto\PolygonService as PolygonCriptService;
use App\Services\Cripto\CurrencyQuoteCriptService;

use App\Objects\Stock\StockObject;
use App\Services\Stock\YahoofinanceStockService;
use App\Services\Stock\PolygonService;
use App\Services\Stock\CurrencyQuoteStockService;

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

        $CurrencyQuote = new CurrencyQuoteCoinObject();
        $CurrencyQuote->setCode($code);
 
        $CoinPrice = new CurrencyQuoteService($API, $CurrencyQuote);

        echo '<pre>';
        print_r($CoinPrice->getPrice());
        echo '</pre>';
    }
);


Route::get('/cripto/{code}',
    function (Request $request, $code)
    {
        // $API = new MercadobitcoinService(new Client);
        // $API = new CoinmarketcapService(new Client);
        $API = new YahoofinanceService(new Client);
        // $API = new PolygonCriptService(new Client);
        // $API = new AlphavantageService(new Client);
        $CriptoObject = new CriptoObject(new CurrencyQuoteCoinObject());

        $CriptoObject->setCode($code);

        $CriptPrice = new CurrencyQuoteCriptService($API, $CriptoObject);

        $API = new AwesomeapiService(new Client);
        $CoinPrice = new CurrencyQuoteService($API, $CriptoObject->getCoin());
        
        $CriptPrice->getPrice()->setCoin($CoinPrice->getPrice());

        echo '<pre>';
        print_r($CriptPrice->getPrice());
        echo '</pre>';
       
    }
);


Route::get('/stocks/{code}',
    function (Request $request, $code)
    {
        // $API = new YahoofinanceStockService(new Client);
        $API = new PolygonService(new Client);
        
        $StockObject = new StockObject(new CurrencyQuoteCoinObject());

        $StockObject->setCode($code);

        $StockPrice = new CurrencyQuoteStockService($API, $StockObject);

        $API = new AwesomeapiService(new Client);
        $CoinPrice = new CurrencyQuoteService($API, $StockObject->getCoin());
        
        $StockPrice->getPrice()->setCoin($CoinPrice->getPrice());

        echo '<pre>';
        print_r($StockPrice->getPrice());
        echo '</pre>';
       
    }
);