<?php

namespace App\Domains\BrazilionStock;

interface YahoofinanceDomain
{
    const URL_START = "https://query2.finance.yahoo.com/v10/finance/quoteSummary/";
    const URL_END = "?modules=price";
    const STOCK_ACRONYM = ".SA";
}
