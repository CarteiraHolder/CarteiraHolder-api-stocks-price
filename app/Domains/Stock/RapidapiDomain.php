<?php

namespace App\Domains\Stock;

interface RapidapiDomain
{
    const URL = "https://alpha-vantage.p.rapidapi.com/query";
    const API_FUNC = "TIME_SERIES_DAILY";
    const API_OUTPUT = "outputsize";
    const API_DATA_TYPE = "json";
    const API_OUTPUTSIZE = "compact";
    const API_X_RAPID_API_KEY = "6b0303cd6dmshbcb89bff2e99f06p147f45jsnd3d63147dd4f";
    const API_X_RAPID_API_HOST = "alpha-vantage.p.rapidapi.com'";

    const NODE = "Time Series (Daily)";
    const NODE_VALUE = "4. close";
}
