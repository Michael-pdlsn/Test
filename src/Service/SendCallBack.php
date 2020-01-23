<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;


/**
 * Class CardCheck
 * @package App\Service
 */
class CardCheck
{
    /**
     * @var array
     */
    private $cards = [];

    /** @var HttpClient */
    private $httpClient;

    /**
     * CardCheck constructor.
     * @param string $cardTrue
     * @param string $cardFalse
     */
    public function __construct(string $cardTrue, string $cardFalse)
    {
        $this->cards = [$cardTrue => true, $cardFalse => false];
        $this->httpClient = HttpClient::create();
    }

    /**
     * @param string $card
     * @return bool
     */
    public function checkCard(string $card,string $callbackUrl)
    {
        $result = $this->cards[$card] ?? false;
        $response = $this->httpClient->request('POST',$callbackUrl, ['payment_status' => $result]);
        $callbackStatusCode = $response->getStatusCode();

        return $result;
    }
}