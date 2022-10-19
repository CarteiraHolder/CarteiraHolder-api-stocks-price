<?php

namespace App\Services\BrazilionStock;

use App\Interfaces\BrazilionStock\ApiBrazilionStockInterface;
use App\Objects\BrazilionStock\BrazilionStockObject;
use App\Domains\BrazilionStock\StatusinvestDomain;

use App\Services\Sector\SectorService;

use GuzzleHttp\Client;

class StatusinvestService extends SectorService implements ApiBrazilionStockInterface, StatusinvestDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        parent::__construct($httpClient);
        $this->httpClient = $httpClient;
    }

    public function callApi(BrazilionStockObject $Stock) : BrazilionStockObject
    {

        return $Stock; 
        //VER DEPOIS PORQUE ESTÁ SALVANDO A ULTIMA COTAÇÃO EM CASH E ERRA A PROXIMA

        $url = self::URL;

        $headers = [
            'Authorization' => 'statusinvest.com.br',
            'Referer' => 'https://statusinvest.com.br/acao/' . $Stock->getCode(),
            'Origin' => 'https://statusinvest.com.br',
        ];

        $form = [
            'form_params' => [
                'ticker' => $Stock->getCode(),
                'type' => self::TYPE,
                'currences[]' => 1
            ],
            'headers' => $headers,
        ];
        
        try {
            $request = $this->httpClient->get($url , $form);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }
        echo $Stock->getCode() . "<br>"; 

        print_r(floatval($requestJson[0]->prices[0]->price));
        
        $Stock->setValue(floatval($requestJson[0]->prices[0]->price));
        $Stock->getCoin()->setCode($this->typeCoin($requestJson[0]->symbol));

        return $Stock;
    }

    private function typeCoin(string $coin) : string
    {
        if($coin == 'R$') return "BRL";
        return "USD";
    }
}
