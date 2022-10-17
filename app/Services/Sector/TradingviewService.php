<?php

namespace App\Services\Sector;

use App\Domains\Sector\TradingviewDomain;
use App\Interfaces\Sector\ApiSectorInterface;

use GuzzleHttp\Client;
use DOMDocument;

class TradingviewService implements TradingviewDomain, ApiSectorInterface
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function getSector(string $code, object $Object) : object
    {
        error_reporting(0);
        set_time_limit(0);

        $url = self::URL . $code;
        
        try {
            $request = $this->httpClient->get($url);
            $requestJson = $request->getBody()->getContents();
        } catch (\Throwable $th) {
            return $Object;
        }

        $dom = new DOMDocument();
		$dom->loadHTML($requestJson);

        $tables = $dom->getElementsByTagName('span');
        
        if(count($tables) == 0 ) return $Object;

        $Object->setSector(utf8_decode(trim($tables[2]->textContent)));
        $Object->setSubsector(utf8_decode(trim($tables[4]->textContent)));
        $Object->setSegment(utf8_decode(trim($tables[4]->textContent)));

        return $Object;
    }

}
