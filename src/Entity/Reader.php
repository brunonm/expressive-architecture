<?php
declare(strict_types=1);

namespace ThatBook\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ThatBook\Exception\ReaderAlreadyHasBookException;

/**
 * @ORM\Entity(repositoryClass="ThatBook\Repository\ReaderRepository")
 */
class Reader
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
    private $name;

    /**
     * @var ArrayCollection | Book[]
     * @ORM\ManyToMany(targetEntity="Book", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *   name="reader_book",
     *   joinColumns={@ORM\JoinColumn(name="reader_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")}
     * )
     */
    private $books;

    /**
     * @var ArrayCollection | Book[]
     * @ORM\ManyToMany(targetEntity="Book", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *   name="wishlist",
     *   joinColumns={@ORM\JoinColumn(name="reader_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")}
     * )
     */
    private $wishlist;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->books = new ArrayCollection();
        $this->wishlist = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function registerBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
        }

        if ($this->wishlist->contains($book)) {
            $this->wishlist->removeElement($book);
        }

        return $this;
    }

    public function registerWish(Book $book): self
    {
        if ($this->books->contains($book)) {
            throw new ReaderAlreadyHasBookException();
        }

        if (!$this->wishlist->contains($book)) {
            $this->wishlist[] = $book;
        }

        return $this;
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function getWishlist(): Collection
    {
        return $this->wishlist;
    }
}
