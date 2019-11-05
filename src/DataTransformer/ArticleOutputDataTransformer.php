<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Article;
use App\Entity\Dto\ArticleInDto;
use App\Entity\Dto\ArticleOutDto;

final class ArticleOutputDataTransformer implements DataTransformerInterface
{
    /**
     * @param Article $object
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {
        $article = new ArticleOutDto();
        $article->id = $object->getId();
        $article->title = $object->getTitle();
        $article->text = $object->getText();
        $article->createdAt = $object->getCreatedAt()->format('Y-m-d H:i:s');
        $article->categories = [];
        foreach ($object->getCategories() as $category) {
            $article->categories[] = $category->getName();
        }

        return $article;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === ArticleOutDto::class && $data instanceof Article;
    }
}
