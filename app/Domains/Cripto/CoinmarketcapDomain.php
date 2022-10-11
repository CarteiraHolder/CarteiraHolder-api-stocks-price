<?php

namespace App\Domains\Cripto;

interface CoinmarketcapDomain
{
    const URL = "https://api.coinmarketcap.com/data-api/v3/cryptocurrency/listing?start=1&limit=10000&sortBy=market_cap&sortType=desc&convert=USD&cryptoType=all&tagType=all&audited=false";

}
