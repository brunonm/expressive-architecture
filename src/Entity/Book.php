<?php
declare(strict_types=1);

namespace ThatBook\Entity;

use Doctrine\ORM\Mapping as ORM;
use ThatBook\Exception\UnknownCategoryException;

/**
 * @ORM\Entity(repositoryClass="ThatBook\Repository\BookRepository")
 */
class Book
{
    const ACCEPTED_CATEGORIES = [
        'ACTION',
        'ADVENTURE',
        'BIOGRAPHY',
        'CHILDREN',
        'COMEDY',
        'FICTION',
        'HISTORY',
        'ROMANCE',
        'THRILLER',
        'HORROR'
    ];

    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $publisher;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $category;

    public function __construct(string $title, string $publisher, string $category)
    {
        if (!in_array($category, self::ACCEPTED_CATEGORIES)) {
            throw new UnknownCategoryException();
        }

        $this->title = $title;
        $this->publisher = $publisher;
        $this->category = $category;
    }

    public function getId(): string
    {
        return $this->id;
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
