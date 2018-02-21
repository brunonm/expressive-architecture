<?php
declare(strict_types=1);

namespace ThatBook\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ThatBook\Repository\TradeRepository")
 */
class Trade
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var Reader
     * @ORM\ManyToOne(targetEntity="Reader")
     */
    private $oldReader;

    /**
     * @var Reader
     * @ORM\ManyToOne(targetEntity="Reader")
     */
    private $newReader;

    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book")
     */
    private $book;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function __construct(Reader $oldReader, Reader $newReader, Book $book)
    {
        $this->oldReader = $oldReader;
        $this->newReader = $newReader;
        $this->book = $book;
        $this->createdAt = new \DateTime();
    }
}
