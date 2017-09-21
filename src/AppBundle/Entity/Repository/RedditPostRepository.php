<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.09.17
 * Time: 20:39
 */
namespace AppBundle\Entity\Repository;
use \Doctrine\ORM\EntityRepository;

class RedditPostRepository extends EntityRepository
{
    public function query($id)
    {
        return $this->getEntityManager()->createQuery(
            "SELECT p, a
            FROM AppBundle\Entity\RedditPost p
            JOIN p.author a
            WHERE p.id > :id
            ORDER by a.name ASC"
        )->setParameter('id', $id)
        ->getResult();
    }
}