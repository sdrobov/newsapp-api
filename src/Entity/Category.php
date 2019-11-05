<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Dto\CategoryDto;

/**
 * Class Category
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="category")
 * @ApiResource(
 *     input=CategoryDto::class,
 *     output=CategoryDto::class,
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
 * @ApiFilter(SearchFilter::class, properties={"name": "exact"})
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

    public function __construct()
    {
        $this->createdAt = new DateTime();
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
