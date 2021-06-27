<?php

namespace App\PersonaApp\Repository;

use App\PersonaApp\Entity\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use Doctrine\ORM\EntityManagerInterface;
use App\GenericRepository;
use Doctrine\Persistence\ManagerRegistry;


class PersonaRepository extends GenericRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Persona::class);
    }


    public function savePerson($nombre, $apellido)
    {
        $newPerson = new Persona();

        $newPerson
            ->setNombre($nombre)
            ->setApellido($apellido);

        $this->getEntityManagerPersona()->persist($newPerson);
        $this->getEntityManagerPersona()->flush();

    }

    public function updatePerson(Persona $person): Persona
    {
        $this->manager->persist($person);
        $this->manager->flush();

        return $person;
    }


    public function removePerson(Persona $person)
    {
        $this->manager->remove($person);
        $this->manager->flush();
    }

 
}