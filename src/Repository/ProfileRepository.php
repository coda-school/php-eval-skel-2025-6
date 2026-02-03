<?php

namespace App\Repository;

use App\Entity\Profile;
use App\Entity\ProfileXProfile;
use App\Entity\Ver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Profile>
 */
class ProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profile::class);
    }

    public function getFollowingVers($email){
        $qb = $this
            ->createQueryBuilder('p1')
            ->select('ver.content', 'ver.likes', 'ver.comments', 'ver.shares', 'ver.date', 'p2.username', 'p2.profile_picture')
            ->innerJoin(ProfileXProfile::class, 'pp', 'WITH', 'pp.profile_one_id = p1.id')
            ->innerJoin(Profile::class, 'p2', 'WITH', 'pp.profile_two_id = p2.id')
            ->innerJoin(Ver::class, 'ver', 'WITH', 'ver.user_id = p2.id')
            ->where('p1.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult();
        return $qb;
    }


}
