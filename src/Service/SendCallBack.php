<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

/**
 * Class SendCallBack
 * @package App\Service
 */
class SendCallBack
{

    /** @var HttpClient */
    private $httpClient;

    /**
     * SendCallBack constructor.
     */
    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    /**
     * @param string $callbackUrl
     * @param bool $paymentStatus
     * @return int
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function send(string $callbackUrl, bool $paymentStatus)
    {
        try {
            $response = $this->httpClient->request('GET', $callbackUrl, ['query' => ['payment_status' => $paymentStatus]]);
            return $response->getStatusCode();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}