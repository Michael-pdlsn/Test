<?php

namespace App\Service;

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

    /**
     * CardCheck constructor.
     * @param string $cardTrue
     * @param string $cardFalse
     */
    public function __construct(string $cardTrue, string $cardFalse)
    {
        $this->cards = [$cardTrue => true, $cardFalse => false];
        return $this;
    }

    /**
     * @param string $card
     * @return bool
     */
    public function checkCard(string $card)
    {
        return $this->cards[$card] ?? false;
    }
}