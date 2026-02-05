<?php

namespace App\Controller\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class toYourProfileController extends AbstractController
{
    #[Route('/profileredirect', name: 'to_your_profile')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $userToProfile = $this->getUser();
        $id = $userToProfile->getId();

        $route = '/profile/'.(string)$id;

        return $this->redirect($route);
    }
}
