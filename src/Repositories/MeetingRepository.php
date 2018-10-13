<?php

namespace damianbal\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class MeetingRepository extends EntityRepository
{
    public function getForPage($page)
    {
        $q = $this->createQueryBuilder('m')
            ->orderBy('m.id', 'DESC')
            ->getQuery();

        $paginator = $this->paginate($q, $page);

        return $paginator;
    }

    /**
     * Search meetings by title
     *
     * @param string $title
     * @return void
     */
    public function search($title)
    {
        $q = $this->createQueryBuilder("m")
                  ->where('m.title LIKE :title')
                  ->setParameter('title', $title . '%')
                  ->getQuery();

        return $q->getResult();
    }

    // https: //anil.io/blog/symfony/doctrine/symfony-and-doctrine-pagination-with-twig/
    public function paginate($dql, $page = 1, $limit = 6)
    {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit

        return $paginator;
    }
}
