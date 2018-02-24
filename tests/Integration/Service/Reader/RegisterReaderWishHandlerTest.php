<?php
declare(strict_types=1);

namespace ThatBook\Tests\Integration\Service\Reader;

use ThatBook\Tests\Integration\AbstractIntegrationTestCase;
use ThatBook\Service\Reader\RegisterReaderWish;
use ThatBook\Entity\Reader;
use ThatBook\Entity\Book;
use ThatBook\Entity\Category;

class RegisterReaderWishHandlerTest extends AbstractIntegrationTestCase
{
    public function testShouldRegisterABook()
    {
        $reader = new Reader('Bruno');
        $this->em->persist($reader);

        $category = new Category('Aventura');
        $this->em->persist($category);

        $book = new Book('Pequeni princípe', 'Tenante', $category);
        $this->em->persist($book);

        $this->em->flush();

        $this->getServiceBus()->handle(new RegisterReaderWish($book->getId(), $reader->getId()));

        $this->assertCount(1, $reader->getWishlist());
        $this->assertEquals($book, $reader->getWishlist()->first());
    }
}
