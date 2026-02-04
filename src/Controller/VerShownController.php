<?php

namespace App\Controller;

use App\Entity\Ver;
use App\Service\ResponseService;
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
        VerService $verService,
        ResponseService $responseService
    ): Response
    {
        $isUserLogged = '_layouts/standard.html.twig';
        $user = $this->getUser();
        if($user){
            $isUserLogged = '_layouts/in_app.html.twig';
        }
        $verInfos = $verService->getSingleVer($ver->getId());
        $responses = $responseService->getResponsesToAVer($ver->getId());

        return $this->render('ver_shown/index.html.twig', [
            'controller_name' => 'VerShownController',
            'ver' => $verInfos,
            'responses' => $responses,
            'isUserLogged' => $isUserLogged,
        ]);
    }
}
