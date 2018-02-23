<?php
declare(strict_types=1);

namespace ThatBook\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ThatBook\Repository\BookRepository")
 */
class Book
{
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
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function __construct(string $title, string $publisher, Category $category)
    {
        $this->title = $title;
        $this->publisher = $publisher;
        $this->category = $category;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
