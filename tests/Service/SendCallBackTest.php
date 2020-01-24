<?php

namespace App\Tests\Service;

use App\Service\SendCallBack;
use PHPUnit\Framework\TestCase;

class SendCallBackTest extends TestCase
{
    public function testSend()
    {
        $callbackUrl = 'http://localhost/';
        $status = true;
        $sendCallBack =  new SendCallBack();
        $this->assertIsNotBool($sendCallBack->send($callbackUrl, $status));
    }
}
