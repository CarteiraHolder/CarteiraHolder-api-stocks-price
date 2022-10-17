<?php

namespace App\Domains\BrazilionStock;

interface LabdoDomain
{
    const URL = "https://api-cotacao-b3.labdo.it/api/cotacao/cd_acao/";
    const COUNT_RETURN = 1;

    const URL_INFO = "https://api-cotacao-b3.labdo.it/api/empresa";
}
