<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ErrorController extends AbstractController
{
    #[Route('/error', name: 'error', methods: ['GET'])]
    public function index(): Response
    {
        $path = 'home';
        $isUserLogged = $this->getUser();
        if($isUserLogged){
            $path = 'home_inapp';
        }
        return $this->render('error/index.html.twig', [
            'controller_name' => 'ErrorController',
            'path' => $path,
        ]);
    }
}
