<?php

namespace App\Controller;

use App\Entity\ProfileXLike;
use App\Entity\Ver;
use App\Service\ProfileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class AddALikeController extends AbstractController
{
    #[Route('/like-adding/{id}', name: 'like-adding', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function create(
        #[MapEntity(mapping: ['id' => 'id'])]
        Ver $ver,
        Request $request,
        ProfileService $profileService,
        EntityManagerInterface $em
    ): Response
    {
        $currentStatus = $request->request->get('like');
        $user = $this->getUser();
        $profileUser = $profileService->getProfile($user->getId());

        if($currentStatus === 'not-liked'){
            $relation = new ProfileXLike();
            $relation->setProfileId($profileUser);
            $relation->setVerId($ver);
            $em->persist($relation);
            $em->flush();
            $ver->setLikes($ver->getLikes() + 1);
            $em->persist($ver);
            $em->flush();
        }else{
            $relationToDelete = $em->getRepository(ProfileXLike::class)->findBy([
                'profile_id' => $profileUser->getId(),
                'ver_id' => $ver->getId()
            ]);
            $em->remove($relationToDelete[0]);
            $em->flush();
            $ver->setLikes($ver->getLikes() - 1);
            $em->persist($ver);
            $em->flush();
        }
        return $this->redirect('/ver/'.$ver->getId());


    }
}
