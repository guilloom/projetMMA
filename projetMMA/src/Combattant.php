<?php
// src/Combattants.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'combattants')]
class Combattant
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'integer')]
    private int $age;
    #[ManyToOne(targetEntity:Nationalite::class)]
    #[JoinColumn(name: 'nationalite_id', referencedColumnName: 'id')]
    private Nationalite|null $nationalite = null;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Combattant
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set age.
     *
     * @param int $age
     *
     * @return Combattant
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age.
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set nationalite.
     *
     * @param \Nationalite|null $nationalite
     *
     * @return Combattant
     */
    public function setNationalite(\Nationalite $nationalite = null)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite.
     *
     * @return \Nationalite|null
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }
}
