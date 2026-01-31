<?php

namespace App\Controller;

use App\Entity\Ver;
use App\Form\VerType;
use App\Repository\ProfileRepository; // On importe le repository de Profile
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VerController extends AbstractController
{
    #[Route('/ver/nouveau', name: 'app_ver_new')]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        ProfileRepository $profileRepository // Injection du repository Profile
    ): Response {
        $ver = new Ver();
        $form = $this->createForm(VerType::class, $ver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // --- LOGIQUE TEMPORAIRE (SANS LOGIN) ---
            // On récupère le premier profil trouvé en base de données
            $testProfile = $profileRepository->findOneBy([]);

            if (!$testProfile) {
                throw new \Exception("Aucun Profile trouvé en base. Créez-en un dans la table 'profile' pour tester !");
            }

            // On lie le profil au Ver
            // Vérifie bien si ta méthode s'appelle setUserId, setProfile ou setAuthor
            $ver->setUserId($testProfile);
            // ----------------------------------------

            $ver->setDate(new \DateTime());
            $ver->setLikes(0);
            $ver->setComments(0);
            $ver->setShares(0);

            $em->persist($ver);
            $em->flush();

            $this->addFlash('success', 'Ton ver a été publié avec le profil : ' . $testProfile->getNickname()); // Ou getId()

            return $this->redirectToRoute('app_ver_new');
        }

        return $this->render('ver/index.html.twig', [
            'verForm' => $form->createView(),
        ]);
    }
}
