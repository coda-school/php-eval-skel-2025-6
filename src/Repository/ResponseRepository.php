<?php

namespace App\Repository;

use App\Entity\Response;
use App\Entity\Ver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Response>
 */
class ResponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Response::class);
    }

    public function getResponsesToAVer($id){
        $qb = $this
            ->createQueryBuilder('r')
            ->innerJoin(Ver::class, 'v', 'WITH', 'r.ver_id = v.id')
            ->select('r.content')
            ->where('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return $qb;
    }

    public function getResponsesToDelete($id){
        $qb = $this
            ->createQueryBuilder('r')
            ->innerJoin(Ver::class, 'v', 'WITH', 'r.ver_id = v.id')
            ->where('v.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return $qb;
    }


}
