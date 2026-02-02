<?php

namespace App\Service;

use App\Entity\Ver;
use App\Repository\VerRepository;

class VerService{
    public function __construct(
        private readonly VerRepository $verRepository
    )
    {
    }

    public function getTrendingVers(){
        return $this->verRepository->getTrendingVers();
    }
}
