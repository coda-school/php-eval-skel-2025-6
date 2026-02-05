<?php

namespace App\Controller\Home;

use App\Service\ProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class InappController extends AbstractController
{
    #[Route('/inapp', name: 'home_inapp', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(ProfileService $profileService): Response
    {
        $loggedUser = $this->getUser();
        $noVers = false;
        $userEmail = $loggedUser->getEmail();

        $vers = $profileService->getFollowingVers($userEmail);
        if(empty($vers)){
            $noVers = true;
        }


        return $this->render('home/inapp/index.html.twig', [
            'controller_name' => 'Home/InappController',
            'vers' => $vers,
            'noVers' => $noVers,
        ]);
    }
}
