<?php

namespace App\Services\Sector;

use App\Domains\Sector\SectorDomain;
use App\Interfaces\Sector\ApiSectorInterface;

use GuzzleHttp\Client;

class SectorService implements SectorDomain, ApiSectorInterface
{
    private Client $httpClient;
    
    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function getSector(string $code, object $Object) : object
    {
        foreach (self::SERVICES as $value) {
            $ClassName = "App\Services\Sector\\" . $value;
            $Class = new $ClassName($this->httpClient);
            $Class->getSector($code, $Object);

            if($Object->getSector() != '') break;
        }

        return $Object;

    }

}
