<?php
declare(strict_types=1);

namespace ThatBook\Tests\Integration\Service;

use ThatBook\Tests\Integration\AbstractIntegrationTestCase;
use ThatBook\Service\RegisterReader;
use ThatBook\Entity\Reader;

class RegisterReaderHandlerTest extends AbstractIntegrationTestCase
{
    public function testShouldRegisterABook()
    {
        $this->getServiceBus()->handle(new RegisterReader('Bruno'));

        $repo = $this->em->getRepository(Reader::class);

        $this->assertCount(1, $repo->findAll());
    }
}
