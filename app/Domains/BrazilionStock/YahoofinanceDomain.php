<?php

namespace App\Domains\BrazilionStock;

interface YahoofinanceDomain
{
    const URL_START = "https://query2.finance.yahoo.com/v8/finance/chart/";
    const URL_END = "?interval=1d";
    const STOCK_ACRONYM = ".SA";
}
