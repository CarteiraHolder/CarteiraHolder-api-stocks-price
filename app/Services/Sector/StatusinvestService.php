<?php

namespace App\Services\Sector;

use App\Domains\Sector\StatusinvestDomains;
use App\Interfaces\Sector\ApiSectorInterface;

use GuzzleHttp\Client;
use DOMDocument;
use DomXPath;

class StatusinvestService implements StatusinvestDomains, ApiSectorInterface
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function getSector(string $code, object $Object) : object
    {
        error_reporting(0);
        set_time_limit(0);
    
        foreach (self::URL as  $value) {
            $url = $value . $code;
            
            try {
                $request = $this->httpClient->get($url);
                $requestJson = $request->getBody()->getContents();

                $dom = new DOMDocument();
                $dom->loadHTML($requestJson);
                $finder = new DomXPath($dom);

                $tables = $finder->query("//*[contains(@class, 'value')]");

                if(count($tables) > 2 ) break;
            } catch (\Throwable $th) {
                continue;
            }

        }
        
        if(count($tables) == 0 ) return $Object;

        $this->setObject($tables, $Object);
        

        return $Object;
    }

    private function setObject(\DOMNodeList $tables, object $Object) : object
    {
        for ($i=0; $i < count($tables); $i++) { 
			if(trim($tables[$i]->textContent) == "Setor de Atuação"){
				$Object->setSector(trim($tables[$i + 1]->textContent)); 	//Setor ;
			}elseif(trim($tables[$i]->textContent) == "Subsetor de Atuação"){
				$Object->setSubsector(trim($tables[$i + 1]->textContent)); 	//SubSetor
			}elseif(trim($tables[$i]->textContent) == "Segmento de Atuação"){
				$Object->setSegment(trim($tables[$i + 1]->textContent)); //Segmento
			}
		}

        return $Object;
    }

}
