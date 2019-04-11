<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Проверка email/password.
     * Возвращает apiToken
     *
     *
     * @param string $email
     * @param string $plainPassword
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return string
     */
    public function authenticate(string $email, string $plainPassword, UserPasswordEncoderInterface $encoder): string
    {
        /** @var User $user */
        $user = $this->findOneBy(['email' => $email]);
        if (!$user) {
            throw new \InvalidArgumentException('User could not be found.');
        }
        if (!$encoder->isPasswordValid($user, $plainPassword)) {
            throw new \InvalidArgumentException('Password is invalid.');
        }
        // We may Reset User.apiToken here

        return $user->getApiToken();
    }
}
