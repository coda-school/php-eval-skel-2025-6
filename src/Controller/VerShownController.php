<?php

namespace App\Controller;

use App\Entity\Ver;
use App\Service\ProfileXLikeService;
use App\Service\ResponseService;
use App\Service\VerService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Response as VerResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ResponseFormType;
final class VerShownController extends AbstractController
{
    #[Route('/ver/{id}', name: 'ver_shown', methods: ['GET', 'POST'])]
    public function index(
        #[MapEntity(mapping: ['id' => 'id'])]
        ?Ver $ver,
        VerService $verService,
        ResponseService $responseService,
        ProfileXLikeService $profileXLikeService,
        Request $request,
        EntityManagerInterface $em
    ): Response
    {
        if(!$ver){
            return $this->redirectToRoute('error');
        }
        $newResponse = new VerResponse();
        $form = $this->createForm(ResponseFormType::class, $newResponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newResponse->setVerId($ver);
            $ver->setComments($ver->getComments() + 1);

            $em->persist($newResponse);
            $em->flush();
            return $this->redirectToRoute('ver_shown', ['id' => $ver->getId()]);
        }

        $alreadyLiked = false;
        $isUserLogged = '_layouts/standard.html.twig';
        $user = $this->getUser();
        if($user){
            $isUserLogged = '_layouts/in_app.html.twig';
            $alreadyLiked = $profileXLikeService->isVerLiked($ver->getId(), $user->getEmail());
        }
        $verInfos = $verService->getSingleVer($ver->getId());
        $responses = $em->getRepository(VerResponse::class)->findBy(['ver_id' => $ver]);

        return $this->render('ver_shown/index.html.twig', [
            'controller_name' => 'VerShownController',
            'ver' => $verInfos,
            'responses' => $responses,
            'isUserLogged' => $isUserLogged,
            'alreadyLiked' => $alreadyLiked,
            'commentForm' => $form->createView(),
        ]);
    }
}
