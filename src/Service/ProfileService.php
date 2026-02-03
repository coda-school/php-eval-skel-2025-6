<?php

namespace App\Service;

use App\Repository\ProfileRepository;
use App\Repository\ResponseRepository;

class ProfileService{

    public function __construct(
        private readonly ProfileRepository $profileRepository
    )
    {
    }

    public function getFollowingVers($email){
        return $this->profileRepository->getFollowingVers($email);
    }
}
