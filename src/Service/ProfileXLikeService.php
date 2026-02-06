<?php

namespace App\Service;

use App\Repository\ProfileXLikeRepository;

class ProfileXLikeService{
    public function __construct(
        private readonly ProfileXLikeRepository $profileXLikeRepository
    )
    {
    }

    public function isVerLiked($verId, $userEmail){
        return $this->profileXLikeRepository->isVerLiked($verId, $userEmail);
    }

    public function getLikesToDelete($id){
        return $this->profileXLikeRepository->getLikesToDelete($id);
    }
}
