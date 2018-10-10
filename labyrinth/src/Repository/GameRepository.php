<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Game;

class GameRepository extends EntityRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function findGameById(string $id): Game
    {
        return $this->entityManager->find('App:Game', $id);
    }
}
