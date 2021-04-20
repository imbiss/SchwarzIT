<?php

namespace App\Repository;

use App\Entity\Portal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Portal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Portal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Portal[]    findAll()
 * @method Portal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class PortalRepository extends ServiceEntityRepository implements PortalInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Portal::class);
        $this->entityManager = $entityManager;
    }

    public function findAllPortals(): Array
    {
        return $this->findAll();
    }

    public function findByLocale(string $locale): Portal
    {
        return $this->findOneBy([
            'locale' => $locale
        ]);
    }

    public function removeByLocale(string $locale): void
    {
        $this->entityManager->remove($this->findByLocale($locale));
        $this->entityManager->flush(); // delete
    }

    public function save(Portal $pe): void
    {
        $this->entityManager->persist($pe);
        $this->entityManager->flush();
    }

}
