<?php

namespace App\Repository;

use App\Entity\Profile;
use App\Entity\ProfileXProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfileXProfile>
 */
class ProfileXProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfileXProfile::class);
    }

    public function isProfileFollowed($profileId, $userEmail)
    {
        $qb = $this
            ->createQueryBuilder('pp')
            ->innerJoin(Profile::class, 'p1', 'WITH', 'pp.profile_one_id = p1.id')
            ->innerJoin(Profile::class, 'p2', 'WITH', 'pp.profile_two_id = p2.id')
            ->where('p1.id = :profileId AND p2.email = :userEmail')
            ->setParameter('profileId', $profileId)
            ->setParameter('userEmail', $userEmail)
            ->getQuery()
            ->getOneOrNullResult();
        if(!$qb){
            $qb = $this
                ->createQueryBuilder('pp')
                ->innerJoin(Profile::class, 'p1', 'WITH', 'pp.profile_one_id = p1.id')
                ->innerJoin(Profile::class, 'p2', 'WITH', 'pp.profile_two_id = p2.id')
                ->where('p2.id = :profileId AND p1.email = :userEmail')
                ->setParameter('profileId', $profileId)
                ->setParameter('userEmail', $userEmail)
                ->getQuery()
                ->getOneOrNullResult();
        }
        return $qb;
    }
}
