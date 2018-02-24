<?php
declare(strict_types=1);

namespace ThatBook\Tests\Unit\Service\Reader;

use ThatBook\Tests\Unit\AbstractUnitTestCase;
use ThatBook\Repository\BookRepository;
use ThatBook\Service\CatalogBook;
use ThatBook\Service\CatalogBookHandler;
use \Mockery as M;

class CatalogBookHandlerTest extends AbstractUnitTestCase
{
    private $handler;

    private $bookRepoMock;

    protected function setUp()
    {
        $this->bookRepoMock = M::mock(BookRepository::class);


        $this->handler = new CatalogBookHandler($this->bookRepoMock);
    }

    public function testShouldRCatalogABook()
    {
        $this->bookRepoMock->shouldReceive('store')->once();

        $command = new CatalogBook('Contra', 'Alta books', 'ACTION');

        $this->handler->handle($command);
    }

    /**
     * @expectedException ThatBook\Exception\UnknownCategoryException
     */
    public function testShouldThrowExceptionIfCategoryNotFound()
    {
        $command = new CatalogBook('Contra', 'Alta books', 'XPTO');

        $this->handler->handle($command);
    }
}
