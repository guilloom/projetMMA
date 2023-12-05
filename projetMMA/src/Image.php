<?php
//src/Images.php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'images')]
class Image
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $image = null;
    #[ORM\Column(type:'string')]
    private string $nom;
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $avatar = null;

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
     * Set image.
     *
     * @param string|null $image
     *
     * @return Image
     */
    public function setImage($image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return base64_encode($this->image);
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Image
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set avatar.
     *
     * @param string|null $avatar
     *
     * @return Image
     */
    public function setAvatar($avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar.
     *
     * @return string|null
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
