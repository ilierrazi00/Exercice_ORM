<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class IAGenerativeTexte extends IAGenerative
{
    /**
     * @ORM\Column(type="text")
     */
    private $texteGenere;

    public function getTexteGenere(): ?string
    {
        return $this->texteGenere;
    }

    public function setTexteGenere(string $texteGenere): self
    {
        $this->texteGenere = $texteGenere;

        return $this;
    }
}
