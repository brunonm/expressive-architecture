<?php
declare(strict_types=1);

namespace ThatBook\Tests\Unit;

use PHPUnit\Framework\TestCase;

abstract class AbstractUnitTestCase extends TestCase
{
    protected function tearDown()
    {
        \Mockery::close();
    }
}
