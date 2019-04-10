<?php

class EntityFactoryTest extends \PHPUnit\Framework\TestCase
{

    public function testMakeUserResult()
    {
        $user = new \App\Entity\User();
        $userResult = \App\Factory\EntityFactory::makeUsersResult($user, '123', '1|1|1', 23);
        $this->assertEquals($userResult->getUser(), $user);
        $this->assertEquals($userResult->getResult(), [
            'request_needle' => '123',
            'request_haystack' => '1|1|1',
            'result' => 23,
        ]);
    }
}