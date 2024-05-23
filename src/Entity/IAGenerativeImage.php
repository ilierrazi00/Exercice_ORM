<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class IAGenerativeImage extends IAGenerative
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageGeneree;

    public function getImageGeneree(): ?string
    {
        return $this->imageGeneree;
    }

    public function setImageGeneree(string $imageGeneree): self
    {
        $this->imageGeneree = $imageGeneree;

        return $this;
    }
}
