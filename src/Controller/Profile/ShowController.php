<?php

namespace App\Controller\Profile;

use App\Entity\Profile;
use App\Service\ProfileService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ShowController extends AbstractController
{
    #[Route('/profile/{id}', name: 'profile_{id}', methods: ['GET'])]
    public function index(
        #[MapEntity(mapping: ['id' => 'id'])]
        Profile $profile,
        ProfileService $profileService,
    ): Response
    {
        $isItYourProfile = false;
        $isUserLogged = '_layouts/standard.html.twig';
        $user = $this->getUser();
        if($user){
            $isUserLogged = '_layouts/in_app.html.twig';
            if($profile->getEmail() === $user->getEmail()){
                $isItYourProfile = true;
            }
        }
        $profileInfos = $profileService->getProfile($profile->getId());



        return $this->render('profile/show/index.html.twig', [
            'controller_name' => 'Profile/ShowController',
            'isUserLogged' => $isUserLogged,
            'profile' => $profileInfos,
            'isItYourProfile' => $isItYourProfile,
        ]);
    }
}
