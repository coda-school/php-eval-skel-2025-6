<?php

namespace App\Controller;

use App\Entity\Ver;
use App\Service\VerService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VerShownController extends AbstractController
{
    #[Route('/ver/{id}', name: 'ver', methods: ['GET'])]
    public function index(
        #[MapEntity(mapping: ['id' => 'id'])]
        Ver $ver,

        VerService $verService
    ): Response
    {
        $verInfos = $verService->getSingleVer($ver->getId());

        return $this->render('ver_shown/index.html.twig', [
            'controller_name' => 'VerShownController',
            'ver' => $verInfos,
        ]);
    }
}
