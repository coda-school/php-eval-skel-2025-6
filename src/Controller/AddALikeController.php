<?php

namespace App\Controller;

use App\Entity\Ver;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddALikeController extends AbstractController
{
    #[Route('/like-adding/{id}', name: 'like-adding', methods: ['POST'])]
    public function create(
        #[MapEntity(mapping: ['id' => 'id'])]
        Ver $ver,
    ): Response
    {
        return
    }
}
