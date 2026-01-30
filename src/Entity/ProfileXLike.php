<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Repository\ProfileXLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileXLikeRepository::class)]
class ProfileXLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ver $ver_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getProfileId(): ?Profile
    {
        return $this->profile_id;
    }

    public function setProfileId(Profile $profile_id): static
    {
        $this->profile_id = $profile_id;

        return $this;
    }

    public function getVerId(): ?Ver
    {
        return $this->ver_id;
    }

    public function setVerId(Ver $ver_id): static
    {
        $this->ver_id = $ver_id;

        return $this;
    }
}
