<?php

namespace App\Services\BrazilionStock;

use App\Interfaces\BrazilionStock\ApiBrazilionStockInterface;
use App\Objects\BrazilionStock\BrazilionStockObject;
use App\Domains\BrazilionStock\LabdoDomain;

use App\Services\Sector\SectorService;

use GuzzleHttp\Client;

class LabdoService extends SectorService implements ApiBrazilionStockInterface, LabdoDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        parent::__construct($httpClient);
        $this->httpClient = $httpClient;
    }

    public function callApi(BrazilionStockObject $Stock) : BrazilionStockObject
    {

        $url = self::URL . $Stock->getCode() . "/" . self::COUNT_RETURN;
        
        try {
            $request = $this->httpClient->get($url);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }

        if(count($requestJson) == 0 ) return $Stock;

        $Stock->setValue($requestJson[0]->vl_fechamento);
        $Stock->getCoin()->setCode($this->CoinRef($requestJson[0]->moeda_ref));

        $this->getInfoCompanies($Stock);
        $this->getSector($Stock->getCode(), $Stock);
        return $Stock;
    }

    private function getInfoCompanies(BrazilionStockObject $Stock) : BrazilionStockObject 
    {
        try {
            $request = $this->httpClient->get(self::URL_INFO);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }

        return $this->findStock($Stock, $requestJson, $Stock->getCode());
    }

    private function findStock(BrazilionStockObject $stock, array $object, string $code) : BrazilionStockObject
    {
        foreach ($object as $key => $value) {
            $codeObject = explode(",",$value->cd_acao);
            $codeObject = array_map('trim', $codeObject);

            if((is_array($codeObject) && !in_array($code, $codeObject)))
                continue;


            $stock->setName($value->nm_empresa);
            $stock->setCnpj($value->vl_cnpj);
            $stock->setSector($value->setor_economico);
            $stock->setSubsector($value->subsetor);
            $stock->setSegment($value->segmento);
        }

        return $stock;
    }

    private function CoinRef(string $ref) : string
    {
        if($ref == "R$") return 'BRL';
        return 'USD';
    }
}
