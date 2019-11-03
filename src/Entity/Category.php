<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="category")
 * @ApiResource()
 */
class Category
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $name;

    /** @ORM\Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"}) */
    private $createdAt;

    /** @ORM\Column(name="updated_at", type="datetime", nullable=true) */
    private $updatedAt;

    /** @ORM\Column(name="deleted_at", type="datetime", nullable=true) */
    private $deletedAt;

    /** @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="categories") */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
