<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserResult[]    findAll()
 * @method UserResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserResultRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserResult::class);
    }

    public function storeResult(UserResult $userResult)
    {
        $this->_em->persist($userResult);
        $this->_em->flush($userResult);
    }
}
