<?php

namespace Tests;

use JimChen\OpenApiSDK\Client;
use JimChen\Utils\Collection;
use OpenApiSDK\Model\InputDirectOrderDto;
use Yii;

class ClientTest extends TestCase
{
    protected function createClient()
    {
        return Yii::createObject([
            'class' => Client::class,
            'sandbox' => true,
            'key' => 'i4esv1l+76l/7NQCL3QudG90Fq+YgVfFGJAWgT+7qO1Bm9o/adG/1iwO2qXsAXNB',
            'secret' => '0a091b3aa4324435aab703142518a8f7',
        ]);
    }

    public function testDirectCharge()
    {
        $dto = new InputDirectOrderDto();
        $dto->customerOrderNo = uniqid('', false);
        $dto->productId = 10000585;
        $dto->buyNum = 1;
        $dto->chargeAccount = '888888';
        $c = $this->createClient()->directCharge($dto);

        self::assertInstanceOf(Collection::class, $c);
        self::assertEquals(0, $c->get('code'));
    }
}
