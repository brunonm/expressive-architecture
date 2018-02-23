<?php
declare(strict_types=1);

namespace ThatBook\Tests\Integration\Service\Reader;

use ThatBook\Tests\Integration\AbstractIntegrationTestCase;
use ThatBook\Service\Reader\RegisterReaderBook;
use ThatBook\Entity\Reader;
use ThatBook\Entity\Book;
use ThatBook\Entity\Category;

class RegisterReaderBookHandlerTest extends AbstractIntegrationTestCase
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

        $this->getServiceBus()->handle(new RegisterReaderBook($book->getId(), $reader->getId()));

        $this->assertCount(1, $reader->getBooks());
        $this->assertEquals($book, $reader->getBooks()->first());
    }
}
