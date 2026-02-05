<?php

namespace App\Controller\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class toYourProfileController extends AbstractController
{
    #[Route('/profile/to/your/profile', name: 'app_profile_to_your_profile')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('profile/to_your_profile/index.html.twig', [
            'controller_name' => 'Profile/toYourProfileController',
        ]);
    }
}
