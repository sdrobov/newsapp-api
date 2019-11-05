<?php


namespace App\Entity\Dto;


final class ArticleOutDto
{
    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $text;

    /** @var string */
    public $createdAt;

    /** @var string[] */
    public $categories;
}
