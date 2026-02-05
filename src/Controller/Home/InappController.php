<?php

namespace App\Controller\Home;

use App\Service\ProfileService;
use App\Service\VerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class InappController extends AbstractController
{
    #[Route('/inapp', name: 'home_inapp', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(
        ProfileService $profileService,
        Request $request,
    ): Response
    {
        $loggedUser = $this->getUser();
        $userEmail = $loggedUser->getEmail();

        $limit = 10;
        $page = max(1, (int) $request->query->get('page', 1));

        $result = $profileService->getFollowingVersPaginated($userEmail, $page, $limit);
        $vers = $result['items'];
        $total = (int) $result['total'];

        $pages = max(1, (int) ceil($total / $limit));
        if ($page > $pages) {
            $page = $pages;
            $result = $profileService->getFollowingVersPaginated($userEmail, $page, $limit);
            $vers = $result['items'];
        }

        $noVers = ($total === 0);

        return $this->render('home/inapp/index.html.twig', [
            'controller_name' => 'Home/InappController',
            'vers' => $vers,
            'noVers' => $noVers,
            'page' => $page,
            'pages' => $pages,
            'total' => $total,
            'limit' => $limit,
        ]);
    }
}
