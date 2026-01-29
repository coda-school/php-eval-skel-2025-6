<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Repository\ProfileXProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileXProfileRepository::class)]
class ProfileXProfile extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile_one_id = null;

    #[ORM\Column]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile_two_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getProfileOneId(): ?int
    {
        return $this->profile_one_id;
    }

    public function setProfileOneId(int $profile_one_id): static
    {
        $this->profile_one_id = $profile_one_id;

        return $this;
    }

    public function getProfileTwoId(): ?int
    {
        return $this->profile_two_id;
    }

    public function setProfileTwoId(int $profile_two_id): static
    {
        $this->profile_two_id = $profile_two_id;

        return $this;
    }
}
