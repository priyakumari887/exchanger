	<?php
/**
 * Custom helpers method.
 */



/**
 * Function to get exchange foreign exchange rate data from the API.
 *
 * @var 
 */
function getForeignExchangeRate()
{
        $url = 'https://api.exchangeratesapi.io/latest?base=USD';
        $json_string = file_get_contents($url);
        $parsed_json = json_decode($json_string);
        return $parsed_json;
}
