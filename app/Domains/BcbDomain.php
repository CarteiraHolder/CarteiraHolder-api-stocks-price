<?php

namespace App\Domains;

interface BcbDomain
{
    const URL_START = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao=';
    const URL_END = '&$top=100&$format=json&$select=cotacaoCompra,cotacaoVenda,dataHoraCotacao';
    
}
