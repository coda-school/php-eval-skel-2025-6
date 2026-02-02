<?php

namespace App\Controller\Home;

use App\Service\VerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(VerService $vers): Response
    {
        $trendingVers = $vers->getTrendingVers();

        return $this->render('home/index/index.html.twig', [
            'controller_name' => 'Home/IndexController',
            'trendingVers' => $trendingVers
        ]);
    }
}
