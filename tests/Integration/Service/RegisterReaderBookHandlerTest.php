<?php
declare(strict_types=1);

namespace ThatBook\Tests\Integration\Service;

use ThatBook\Tests\Integration\AbstractIntegrationTestCase;
use ThatBook\Service\RegisterReaderBook;
use ThatBook\Entity\Reader;
use ThatBook\Entity\Book;

class RegisterReaderBookHandlerTest extends AbstractIntegrationTestCase
{
    public function testShouldRegisterABook()
    {
        $reader = new Reader('Bruno');
        $this->em->persist($reader);

        $book = new Book('Pequeni princípe', 'Tenante', 'CHILDREN');
        $this->em->persist($book);

        $this->em->flush();

        $this->getServiceBus()->handle(new RegisterReaderBook($book->getId(), $reader->getId()));

        $this->assertCount(1, $reader->getBooks());
        $this->assertEquals($book, $reader->getBooks()->first());
    }
}
