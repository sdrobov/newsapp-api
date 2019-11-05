<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Entity\Category;
use App\Entity\Dto\CategoryDto;

final class CategoryInputDataTransformer implements DataTransformerInterface
{
    /**
     * @param CategoryDto $object
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {
        /** @var Category $category */
        $category = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE];
        $category->setName($object->name);

        return $category;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === Category::class && $data instanceof CategoryDto;
    }
}
