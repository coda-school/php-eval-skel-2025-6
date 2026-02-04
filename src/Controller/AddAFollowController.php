<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\ProfileXProfile;
use App\Service\ProfileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddAFollowController extends AbstractController
{
    #[Route('/follow-adding/{id}', name: 'follow-adding', methods: ['POST'])]
    public function create(
        #[MapEntity(mapping: ['id' => 'id'])]
        Profile $profile,
        Request $request,
        ProfileService $profileService,
        EntityManagerInterface $em
    ): Response
    {
        $currentStatus = $request->request->get('follow');
        $user = $this->getUser();

        if($currentStatus === 'not-followed'){
            $relation = new ProfileXProfile();
            $relation->setProfileOneId($profileService->getProfile($user->getId()));
            $relation->setProfileTwoId($profile);
            $em->persist($relation);
            $em->flush();
        }else{
            $relationToDelete = $em->getRepository(ProfileXProfile::class)->findBy([
                'profile_one_id' => $user->getId(),
                'profile_two_id' => $profile->getId()
            ]);
            if(!$relationToDelete){
                $relationToDelete = $em->getRepository(ProfileXProfile::class)->findBy([
                    'profile_one_id' => $profile->getId(),
                    'profile_two_id' => $user->getId()
                ]);
            }
            $em->remove($relationToDelete[0]);
            $em->flush();
        }
        return $this->redirect('/profile/'.$profile->getId());
    }
}
