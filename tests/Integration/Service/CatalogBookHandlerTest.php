<?php
declare(strict_types=1);

namespace ThatBook\Tests\Integration\Service;

use ThatBook\Tests\Integration\AbstractIntegrationTestCase;
use ThatBook\Service\CatalogBook;
use ThatBook\Entity\Book;

class CatalogBookHandlerTest extends AbstractIntegrationTestCase
{
    public function testShouldRegisterABook()
    {
        $this->getServiceBus()->handle(new CatalogBook('Pequeni princípe', 'Tenante', 'CHILDREN'));

        $books = $this->em->getRepository(Book::class)->findAll();
        $this->assertCount(1, $books);
        $this->assertEquals('Pequeni princípe', $books[0]->getTitle());
    }
}
