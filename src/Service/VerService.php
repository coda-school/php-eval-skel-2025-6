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
    public function getSingleVer($id){
        return $this->verRepository->getSingleVer($id);
    }

    public function getVersOfAProfile($id){
        return $this->verRepository->getVersOfAProfile($id);
    }
}
