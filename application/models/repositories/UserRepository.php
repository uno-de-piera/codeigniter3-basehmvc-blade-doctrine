<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class UserRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\User";

    /**
     * @param $username
     * @return null|object
     */
    public function findByUsername($username)
    {
        return $this->_em->getRepository($this->entity)->findOneBy(["username" => $username]);
    }
}