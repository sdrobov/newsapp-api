<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Article;
use App\Entity\Dto\ArticleDto;

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
        $article = new ArticleDto();
        $article->id = $object->getId();
        $article->title = $object->getTitle();
        $article->text = $object->getText();
        $article->categories = [];
        foreach ($object->getCategories() as $category) {
            $article->categories[] = $category->getId();
        }

        return $article;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof ArticleDto) {
            return false;
        }

        return $to === Article::class;
    }
}
