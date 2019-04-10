<?php

namespace App\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class PasswordEncoderService.
 * Сервис генерации/валидации паролей юзеров для паблик инжекта
 *
 * @package App\Service
 */
class PasswordEncoderService implements UserPasswordEncoderInterface
{
    /** @var UserPasswordEncoderInterface */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function encodePassword(UserInterface $user, $password)
    {
        return $this->encoder->encodePassword($user, $password);
    }

    public function isPasswordValid(UserInterface $user, $password)
    {
        return $this->encoder->isPasswordValid($user, $password);
    }
}