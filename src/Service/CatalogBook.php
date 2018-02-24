<?php
declare(strict_types=1);

namespace ThatBook\Service;

class CatalogBook
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $publisher;

    /**
     * @var string
     */
    private $category;

    public function __construct(string $title, string $publisher, string $category)
    {
        $this->title = $title;
        $this->publisher = $publisher;
        $this->category = $category;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}
