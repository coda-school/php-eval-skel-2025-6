<?php

namespace App\Service;

use App\Repository\ProfileRepository;

class ProfileService{

    public function __construct(
        private readonly ProfileRepository $profileRepository
    )
    {
    }

    public function getFollowingVers($email){
        return $this->profileRepository->getFollowingVers($email);
    }

    public function getFollowingVersPaginated(string $email, int $page, int $limit): array
    {
        return $this->profileRepository->getFollowingVersPaginated($email, $page, $limit);
    }

    public function getProfile($id){
        return $this->profileRepository->getProfile($id);
    }

    public function getProfileInfos($id){
        return $this->profileRepository->getProfileInfos($id);
    }

    public function getProfileWithEmail($email){
        return $this->profileRepository->getProfileWithEmail($email);
    }
}
