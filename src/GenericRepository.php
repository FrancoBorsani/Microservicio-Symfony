<?php

namespace App;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
    

abstract class GenericRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }


    public function getEntityManagerPersona(){
        return $this->getEntityManager('microservice');
    }

    public function getEntityManagerNumero(){
        return $this->getEntityManager('microservice');
    }


}
