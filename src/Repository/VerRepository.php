<?php

namespace App\Repository;

use App\Entity\Profile;
use App\Entity\Ver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ver>
 */
class VerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ver::class);
    }

    public function getTrendingVers(){
        $qb = $this
            ->createQueryBuilder('ver')
            ->innerJoin(Profile::class, 'p', 'WITH', 'ver.user_id = p.id')
            ->select('ver.id', 'ver.content', 'ver.likes', 'ver.comments', 'ver.shares', 'ver.date', 'p.username', 'p.profile_picture')
            ->orderBy('ver.likes', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
        return $qb;
    }

    public function getSingleVer($id){
        $qb = $this
            ->createQueryBuilder('ver')
            ->innerJoin(Profile::class, 'p', 'WITH', 'ver.user_id = p.id')
            ->select('ver.id', 'ver.content', 'ver.likes', 'ver.comments', 'ver.shares', 'ver.date','p.id as pid',  'p.username', 'p.profile_picture')
            ->where('ver.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }

    public function getVersOfAProfile($id){
        $qb = $this
            ->createQueryBuilder('v')
            ->innerJoin(Profile::class, 'p', 'WITH', 'v.user_id = p.id')
            ->select('v.id', 'v.content', 'v.likes', 'v.date', 'v.comments', 'v.shares', 'p.username', 'p.profile_picture')
            ->where('v.user_id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return $qb;
    }


}
