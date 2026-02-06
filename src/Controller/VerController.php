<?php

namespace App\Controller;

use App\Entity\Ver;
use App\Form\VerType;
use App\Service\ResponseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class VerController extends AbstractController
{
    #[Route('/ver/nouveau', name: 'app_ver_new')]
    #[IsGranted('ROLE_USER')]
    public function new(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $ver = new Ver();
        $form = $this->createForm(VerType::class, $ver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\Profile $user */
            $user = $this->getUser();

            $ver->setUserId($user);

            $ver->setDate(new \DateTime());
            $ver->setLikes(0);
            $ver->setComments(0);
            $ver->setShares(0);

            $em->persist($ver);
            $em->flush();

            $this->addFlash('success', 'Ton ver a été publié avec le profil : ' . $user->getUsername());

            return $this->redirectToRoute('app_ver_new');
        }

        return $this->render('ver/index.html.twig', [
            'verForm' => $form->createView(),
        ]);
    }

    #[Route('/ver/modifier/{id}', name: 'app_ver_edit')]
    #[IsGranted('ROLE_USER')]
    public function edit(
        Ver $ver,
        Request $request,
        EntityManagerInterface $em
    ): response {
        if ($ver->getUserId() !== $this->getUser()) {
            throw $this->createAccessDeniedException("Tu ne peux pas modifier ce ver !");
        }

        $form = $this->createForm(VerType::class, $ver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ver mis à jour !');
            return $this->redirectToRoute('home');
        }

        return $this->render('ver/edit.html.twig', [
            'verForm' => $form->createView(),
            'ver' => $ver,
        ]);
    }

    #[Route('/ver/supprimer/{id}', name: 'app_ver_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(
        Ver $ver,
        Request $request,
        EntityManagerInterface $em,
        ResponseService $responseService
    ): Response {
        if ($ver->getUserId() !== $this->getUser()) {
            throw $this->createAccessDeniedException("Action interdite.");
        }

        if ($this->isCsrfTokenValid('delete' . $ver->getId(), $request->request->get('_token'))) {
            $responses = $responseService->getResponsesToDelete($ver->getId());
            if($responses){
                foreach ($responses as $response){
                    $em->remove($response);
                    $em->flush();
                }
            }
            $em->remove($ver);
            $em->flush();
            $this->addFlash('success', 'Le ver a été supprimé.');
        }
        return $this->redirectToRoute('home');
    }

}
