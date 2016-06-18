<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class PostRepository
 * @package Repositories
 */
class PostRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Post";

    /**
     * @param $title
     * @return null|object
     */
    public function findByTitle($title)
    {
        return $this->_em->getRepository($this->entity)->findOneBy(["title" => $title]);
    }
}