<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Dto\ArticleInDto;
use App\Entity\Dto\ArticleOutDto;

/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 * @ApiResource(
 *     input=ArticleInDto::class,
 *     output=ArticleOutDto::class,
 *     collectionOperations={
 *      "get",
 *      "post"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     itemOperations={
 *      "get",
 *      "delete"={"security"="is_granted('ROLE_ADMIN')"},
 *      "put"={"security"="is_granted('ROLE_ADMIN')"},
 *      "patch"={"security"="is_granted('ROLE_ADMIN')"}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"title": "partial", "text": "partial", "categories.name": "exact"})
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

    /**
     * @ORM\ManyToMany(targetEntity="Category")
     * @ORM\JoinTable(
     *     name="article_category",
     *     joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->createdAt = new DateTime();
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

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category[] $categories
     */
    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

    public function addCategory(Category $category): void
    {
        $this->categories = $category;
    }
}
