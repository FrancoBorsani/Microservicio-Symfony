<?php

namespace App\ServiceApp\Repository;

use App\ServiceApp\Entity\Numero;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use Doctrine\ORM\EntityManagerInterface;
use App\GenericRepository;
use Doctrine\Persistence\ManagerRegistry;


class NumeroRepository extends GenericRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Numero::class);
    }


    public function saveNumero($numero)
    {
        $newNumero = new Numero();

        $newNumero
            ->setNumero($numero);

        $this->getEntityManagerNumero()->persist($newNumero);
        $this->getEntityManagerNumero()->flush();

    }

    public function __toString(){
        return '--';
    }

 
}