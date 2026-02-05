<?php

namespace App\Controller\Home;

use App\Service\VerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(VerService $vers, Request $request): Response
    {
        $isUserLogged = false;
        $path = '_layouts/standard.html.twig';
        if ($this->getUser()) {
            $isUserLogged = true;
            $path = '_layouts/in_app.html.twig';
        }

        $limit = 10;
        $page = max(1, (int) $request->query->get('page', 1));

        $result = $vers->getTrendingVersPaginated($page, $limit);
        $trendingVers = $result['items'];
        $total = (int) $result['total'];

        $pages = max(1, (int) ceil($total / $limit));
        if ($page > $pages) {
            $page = $pages;
            $result = $vers->getTrendingVersPaginated($page, $limit);
            $trendingVers = $result['items'];
        }

        return $this->render('home/index/index.html.twig', [
            'controller_name' => 'Home/IndexController',
            'trendingVers' => $trendingVers,
            'isUserLogged' => $isUserLogged,
            'path' => $path,
            'page' => $page,
            'pages' => $pages,
            'total' => $total,
            'limit' => $limit,
        ]);
    }
}
