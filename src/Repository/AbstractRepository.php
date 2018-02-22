<?php
declare(strict_types=1);

namespace ThatBook\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    public function store($entity): void
    {
        $this->_em->persist($entity);
    }
}
