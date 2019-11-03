<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 * @ApiResource()
 */
class Article
{
    /** @ORM\Id @ORM\GeneratedValue(strategy="AUTO") @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $title;

    /** @ORM\Column(type="string") */
    private $text;

    /** @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}) */
    private $createdAt;

    /** @ORM\Column(type="datetime", nullable=true) */
    private $updatedAt;

    /** @ORM\Column(type="datetime", nullable=true) */
    private $deletedAt;

    /** @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="articles") @ORM\JoinTable(name="article_category") */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText($text): void
    {
        $this->text = $text;
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
