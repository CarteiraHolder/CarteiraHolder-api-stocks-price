<?php

namespace App\Domains\Stock;

interface YahoofinanceDomain
{
    // const URL_START = "https://query2.finance.yahoo.com/v8/finance/chart/";
    // const URL_END = "?interval=1d";

    const URL_START = "https://query2.finance.yahoo.com/v10/finance/quoteSummary/";
    const URL_END = "?modules=price";
}
