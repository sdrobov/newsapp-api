<?php


namespace App\Entity\Dto;


final class ArticleDto
{
    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $text;

    /** @var int[] */
    public $categories;
}
