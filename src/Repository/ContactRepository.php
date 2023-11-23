<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contact>
 *
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @param string $txt contact que l'on recherche
     *
     * @return Contact[] Liste de contact
     */
    public function search(string $txt = ''): array
    {
        $request = $this->createQueryBuilder('contact')
                ->where('contact.lastname LIKE :txt')
                ->orWhere('contact.firstname LIKE :txt')
                ->setParameter(':txt', '%'.$txt.'%')
                ->orderBy('contact.firstname')
                ->orderBy('contact.lastname');

        $query = $request->getQuery();

        return $query->execute();
    }

    public function findWithCategory(int $id): ?Contact
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('App\Entity\Category', 'cat', 'WITH', 'c.category=cat')
            ->addSelect('')
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return Contact[] Returns an array of Contact objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Contact
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
