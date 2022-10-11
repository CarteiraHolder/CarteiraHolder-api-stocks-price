<?php

namespace App\Domains\Cripto;

interface AlphavantageDomain
{
    const URL_START = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=";
    const URL_END = "&to_currency=CNY&apikey=";
    const API_KEY = "A3YBPNTYMKRJAPNK";
    //Não tenho a KEY Premium
}
