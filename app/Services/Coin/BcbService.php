<?php 

namespace App\Services\Coin;

use App\Interfaces\Coin\ApiCoinsInterface;
use App\Domains\Coin\BcbDomain;

use App\Objects\Coin\CurrencyQuoteObject;

use GuzzleHttp\Client;

class BcbService implements ApiCoinsInterface, BcbDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }
    
    public function callApi(CurrencyQuoteObject $CurrencyQuote) : CurrencyQuoteObject
    {
        $url = self::URL_START . "'" . $this->getYesterday() . "'" . self::URL_END;
        $request = $this->httpClient->get($url);

        try {
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $CurrencyQuote;
        }

        if(!$this->NodeGreaterZero($requestJson->value)){
            return $CurrencyQuote;
        }

        $CurrencyQuote->setValue($requestJson->value[0]->cotacaoCompra);
        $CurrencyQuote->setDate($requestJson->value[0]->dataHoraCotacao);

        return $CurrencyQuote;
    }

    private function getYesterday() : string 
    {
        return date('m-d-Y',mktime(0,0,0,date("m"),date("d")- 1 ,date("Y")));
    }

    private function NodeGreaterZero(array $array) : bool
    {
        return count($array) > 0;
    }
}
