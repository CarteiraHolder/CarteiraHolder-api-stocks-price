<?php

namespace App\Interfaces\Cripto;

use App\Objects\Cripto\CriptoObject;

interface ApiCriptoInterface 
{
    public function callApi(CriptoObject $Cripto) : CriptoObject;
}