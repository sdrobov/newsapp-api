<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Entity\Article;
use App\Entity\Dto\ArticleInDto;

final class ArticleInputDataTransformer implements DataTransformerInterface
{
    /**
     * @param ArticleInDto $object
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {
        /** @var Article $article */
        $article = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE];
        $article->setTitle($object->title);
        $article->setText($object->text);

        return $article;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === Article::class && $data instanceof ArticleInDto;
    }
}
