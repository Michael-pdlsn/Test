<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Transaction
 * @package App\Entity
 */
class Transaction
{
    /**
     * @Assert\CardScheme(
     *     schemes={"VISA", "AMEX", "CHINA_UNIONPAY", "DINERS", "DISCOVER", "INSTAPAYMENT", "JCB", "LASER", "MAESTRO", "MASTERCARD", "MIR", "UATP"},
     *     message="Your credit card number is invalid."
     * )
     */
    private $cardNumber;

    /**
     * @Assert\Regex("/[\d]{3}/", message="Your cvv is invalid.")
     */
    private $cardCVV;

    /**
     * @Assert\Regex("/^\w+\s\w+/", message="Holder is invalid.")
     */
    private $cardHolder;

    /**
     * @Assert\Url(message="Invalid callBack url")
     */
    private $callBackUrl;

    /**
     * @Assert\Url(message="Invalid referer url")
     */
    private $refererUrl;


    /**
     * @return mixed
     */
    public function getCallBackUrl()
    {
        return $this->callBackUrl;
    }

    /**
     * @param mixed $callBackUrl
     */
    public function setCallBackUrl($callBackUrl): void
    {
        $this->callBackUrl = $callBackUrl;
    }

    /**
     * @return mixed
     */
    public function getRefererUrl()
    {
        return $this->refererUrl;
    }

    /**
     * @param mixed $refererUrl
     */
    public function setRefererUrl($refererUrl): void
    {
        $this->refererUrl = $refererUrl;
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param mixed $cardNumber
     */
    public function setCardNumber($cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return mixed
     */
    public function getCardCVV()
    {
        return $this->cardCVV;
    }

    /**
     * @param mixed $cardCVV
     */
    public function setCardCVV($cardCVV): void
    {
        $this->cardCVV = $cardCVV;
    }

    /**
     * @return mixed
     */
    public function getCardHolder()
    {
        return $this->cardHolder;
    }

    /**
     * @param mixed $cardHolder
     */
    public function setCardHolder($cardHolder): void
    {
        $this->cardHolder = $cardHolder;
    }

}