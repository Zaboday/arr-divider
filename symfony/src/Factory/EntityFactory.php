<?php

namespace App\Factory;

use App\Entity\User;
use App\Entity\UserResult;

class EntityFactory
{
    /**
     * @param User $user
     * @param $needleAsString
     * @param $haystackAsString
     * @param $result
     *
     * @return UserResult
     */
    public static function makeUsersResult(User $user, $needleAsString, $haystackAsString, int $result): UserResult
    {
        $userResult = new UserResult();
        $userResult->setUser($user);
        $userResult->setResult([
            'request_needle' => $needleAsString,
            'request_haystack' => $haystackAsString,
            'result' => $result,
        ]);

        return $userResult;
    }

}