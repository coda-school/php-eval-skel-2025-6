<?php

namespace App\Controller;

use App\Entity\Ver;
use App\Form\VerType;
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
}
