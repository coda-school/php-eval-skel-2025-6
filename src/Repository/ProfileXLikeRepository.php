<?php

namespace App\Repository;

use App\Entity\Profile;
use App\Entity\ProfileXLike;
use App\Entity\Ver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfileXLike>
 */
class ProfileXLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfileXLike::class);
    }

    public function isVerLiked($verId, $userEmail){
        $qb = $this
            ->createQueryBuilder('pl')
            ->innerJoin(Profile::class, 'p', 'WITH', 'pl.ver_id = p.id')
            ->innerJoin(Ver::class, 'v', 'WITH', 'pl.ver_id = v.id')
            ->where('p.email = :userEmail AND v.id = :verId')
            ->setParameter('userEmail', $userEmail)
            ->setParameter('verId', $verId)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }

}
