<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 09.05.2018
 * Time: 15:15
 */

namespace AppBundle\Repository;


use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        try {
            return $this->createQueryBuilder('u')
                ->where('u.username = :username OR u.email = :email')
                ->setParameter('username', $username)
                ->setParameter('email', $username)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
}