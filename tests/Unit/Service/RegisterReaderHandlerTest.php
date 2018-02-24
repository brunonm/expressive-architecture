<?php
declare(strict_types=1);

namespace ThatBook\Tests\Unit\Service;

use ThatBook\Tests\Unit\AbstractUnitTestCase;
use ThatBook\Repository\ReaderRepository;
use ThatBook\Service\RegisterReader;
use ThatBook\Service\RegisterReaderHandler;
use \Mockery as M;

class RegisterReaderHandlerTest extends AbstractUnitTestCase
{
    private $handler;

    private $readerRepoMock;

    protected function setUp()
    {
        $this->readerRepoMock = M::mock(ReaderRepository::class);
        $this->handler = new RegisterReaderHandler($this->readerRepoMock);
    }

    public function testShouldRCatalogAReader()
    {
        $this->readerRepoMock->shouldReceive('store')->once();

        $command = new RegisterReader('Alice');

        $this->handler->handle($command);
    }
}
