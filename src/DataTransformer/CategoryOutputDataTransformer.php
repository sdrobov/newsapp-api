<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Category;
use App\Entity\Dto\CategoryDto;

final class CategoryOutputDataTransformer implements DataTransformerInterface
{
    /**
     * @param Category $object
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {
        $category = new CategoryDto();
        $category->id = $object->getId();
        $category->name = $object->getName();

        return $category;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === CategoryDto::class && $data instanceof Category;
    }
}
