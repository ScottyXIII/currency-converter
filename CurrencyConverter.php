<?php 

namespace App\Helpers;

use GuzzleHttp\Client;

class CurrencyConverter {

	protected const BASE_API_URL = 'https://api.exchangerate-api.com/v4/latest/';

	protected $currencyFrom = 'USD';

	protected $currencyTo = 'GBP';

	protected $guzzleHttp;

	protected $exchangeRate;

	public function __construct() 
	{
		$this->guzzleHttp = new \GuzzleHttp\Client([
			'headers' => ['User-Agent' => 'testing/1.0'],
			'verify' => false
		]);
	}

	public function setCurrencyToConvert($currency) 
	{
		$this->currencyFrom = $currency;
	}


	public function setConvertedCurrency($currency) 
	{
		$this->currencyTo = $currency;
	}

	public function getExchangeRate()
	{
		$response = $this->guzzleHttp->request('GET', self::BASE_API_URL .  '/' . $this->currencyFrom);

	 	$this->exchangeRate = $response->getBody(true);
		$this->exchangeRate = json_decode($this->exchangeRate)->rates->$currencyTo;

		return $this->exchangeRate;
	}
}
