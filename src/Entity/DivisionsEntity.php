<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DivisionsEntity
 *
 * @ORM\Table(name="divisions")
 * @ORM\Entity
 */
class DivisionsEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="division", type="string", length=255, nullable=false)
     */
    private $division = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDivision(): string
    {
        return $this->division;
    }

    /**
     * @param string $division
     */
    public function setDivision(string $division): void
    {
        $this->division = $division;
    }
}
