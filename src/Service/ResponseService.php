<?php

namespace App\Service;

use App\Repository\ResponseRepository;

class ResponseService{

    public function __construct(
        private readonly ResponseRepository $responseRepository
    )
    {
    }

    public function getResponsesToAVer($id){
        return $this->responseRepository->getResponsesToAVer($id);
    }
}
