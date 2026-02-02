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
            ->select('ver.content', 'ver.likes', 'ver.comments', 'ver.shares', 'ver.date', 'p.username', 'p.profile_picture')
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
            ->select('ver.content', 'ver.likes', 'ver.comments', 'ver.shares', 'ver.date', 'p.username', 'p.profile_picture')
            ->where('ver.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }
}
