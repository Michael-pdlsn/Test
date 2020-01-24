<?php

namespace App\Tests\Service;

use App\Service\CardCheck;
use PHPUnit\Framework\TestCase;

class CardCheckTest extends TestCase
{

    public function testCheckCard()
    {
        $cardTrue = "1";
        $cardFalse = "2";

        $cardCheck = new CardCheck($cardTrue, $cardFalse);

        $this->assertTrue($cardCheck->checkCard($cardTrue));
        $this->assertFalse($cardCheck->checkCard($cardFalse));
    }
}
