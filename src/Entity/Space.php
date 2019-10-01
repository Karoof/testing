<?php


namespace App\Entity;


class Space
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isEmpty;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Parking", inversedBy="spaces")
     */
    private $parking;

    public function __construct(string $name, bool $isEmpty, Parking $parking)
    {
        $this->name = $name;
        $this->isEmpty = $isEmpty;
        $this->parking = $parking;
    }

    public function getIsEmpty(): bool
    {
        return $this->isEmpty;
    }
}