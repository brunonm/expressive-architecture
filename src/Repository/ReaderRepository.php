<?php
declare(strict_types=1);

namespace ThatBook\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use ThatBook\Entity\Reader;

class ReaderRepository  extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reader::class);
    }
}
