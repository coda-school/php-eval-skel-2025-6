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

    public function getProfile($id): Profile{
        $qb = $this
            ->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }

    public function getProfileInfos($id){
        $qb = $this
            ->createQueryBuilder('p')
            ->where('p.id = :id')
            ->select('p.id', 'p.username', 'p.email', 'p.bio', 'p.followers', 'p.following', 'p.profile_picture')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }

    public function getProfileWithEmail($email){
        $qb = $this
            ->createQueryBuilder('p')
            ->select('p.username', 'p.email', 'p.password', 'p.bio', 'p.followers', 'p.following', 'p.profile_picture')
            ->where('p.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }


}
