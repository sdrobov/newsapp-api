<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Entity\Article;
use App\Entity\Dto\ArticleDto;
use App\Repository\CategoryRepository;

final class ArticleInputDataTransformer implements DataTransformerInterface
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param ArticleDto $object
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

        foreach ($object->categories as $categoryId) {
            if ($category = $this->categoryRepository->find($categoryId)) {
                $article->addCategory($category);
            }
        }

        return $article;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Article) {
            return false;
        }

        return $to === ArticleDto::class;
    }
}
