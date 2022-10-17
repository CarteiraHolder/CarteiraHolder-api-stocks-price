<?php

namespace App\Interfaces\Sector;


interface ApiSectorInterface 
{
    public function getSector(string $code, object $Object) : object;
}