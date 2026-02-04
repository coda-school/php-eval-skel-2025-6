<?php

namespace App\Service;

use App\Repository\ProfileXProfileRepository;

class ProfileXProfileService{

    public function __construct(
        private readonly ProfileXProfileRepository $profileXProfileRepository
    )
    {
    }

    public function isProfileFollowed($profileId, $userEmail){
        return $this->profileXProfileRepository->isProfileFollowed($profileId, $userEmail);
    }
}
