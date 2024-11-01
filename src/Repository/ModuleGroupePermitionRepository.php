<?php

namespace App\Repository;

use App\Entity\GroupeModule;
use App\Entity\Groupe;
use App\Entity\Icon;
use App\Entity\ModuleGroupePermition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModuleGroupePermition>
 *
 * @method ModuleGroupePermition|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModuleGroupePermition|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModuleGroupePermition[]    findAll()
 * @method ModuleGroupePermition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModuleGroupePermitionRepository extends ServiceEntityRepository
{

    use TableInfoTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModuleGroupePermition::class);
    }

    public function save(ModuleGroupePermition $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ModuleGroupePermition $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function  getPermission($groupe, $lien)
    {
        $resultat = $this->createQueryBuilder('m')
            ->select('p.code', 'm.menuPrincipal')
            //            ->where('m.groupeUser = : val')
            ->innerJoin('m.permition', 'p')
            ->innerJoin('m.groupeModule', 'gm')
            ->innerJoin('m.groupeUser', 'gu')
            ->andWhere('gm.lien = :lien')
            ->andWhere('gu.id = :val')
            ->setParameters(['val' => $groupe, 'lien' => $lien])
            /*  ->setMaxResults(10)*/
            ->getQuery()
            ->getOneOrNullResult();



        return $resultat;
    }

    public function  afficheModule($groupe)
    {
        return $this->createQueryBuilder('m')
            ->select('md.id', 'md.titre', 'md.ordre')
            //            ->where('m.groupeUser = : val')
            ->innerJoin('m.module', 'md')
            ->innerJoin('m.groupeUser', 'gu')
            ->andWhere('gu.id = :val')
            ->setParameter('val', $groupe)
            ->groupBy('md.id')
            ->orderBy('md.ordre', 'ASC')
            /*  ->setMaxResults(10)*/
            ->getQuery()
            ->getResult();
    }/*
    public function affiche($params)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = "
            SELECT m.groupe_module_id,m.module_id,g.titre,g.lien,i.code as icon
            FROM module_groupe_permition m
        
            INNER JOIN groupe_module as g on g.id=m.groupe_module_id
            INNER JOIN user_groupe as gu on gu.id=m.groupe_user_id
            INNER JOIN icon as i on g.icon_id = i.id
    
          where gu.id = $params and m.menu_principal =1
             order by m.ordre_groupe ASC
           
            ";

        $stmt = $conn->executeQuery($sql);
        return $stmt->fetchAllAssociative();
    }*/
    public function affiche($groupe,$menuPrincipal): array
    {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();
        $tableModuleGroupePermition = $this->getTableName(ModuleGroupePermition::class, $em);
        $tablegGroupeModule = $this->getTableName(GroupeModule::class, $em);
        $tablegGroupe = $this->getTableName(Groupe::class, $em);
        $tablegIcon = $this->getTableName(Icon::class, $em);

            $sql = <<<SQL
            SELECT  m.groupe_module_id,m.module_id,g.titre,g.lien,i.code as icon
           FROM {$tableModuleGroupePermition} as m
            INNER JOIN {$tablegGroupeModule} as g  on g.id=m.groupe_module_id
            INNER JOIN {$tablegGroupe} as gu on gu.id=m.groupe_user_id
            INNER JOIN {$tablegIcon} as i on g.icon_id = i.id
            where gu.id =:groupe and m.menu_principal =1
             order by m.ordre_groupe ASC

           SQL;


        $ands = [];



        if ($ands) {
            $sql .= ' AND ';
        }


        $sql .=  implode(' AND ', $ands);

        /*$sql .= " WHERE e.id =:employe and DATE_FORMAT(d.date_debut,'%M') =:date";
        $sql .= ' GROUP BY d.nbre_jour,jour';*/
       /* if($etat == null){
            $sql .= ' WHERE e.id =:employe and YEAR(date_debut) in (:date)';
            $sql .= ' GROUP BY mois';
        }else{

            $sql .= " WHERE e.id =:employe and DATE_FORMAT(d.date_debut,'%M') =:date";
            $sql .= ' GROUP BY d.nbre_jour,jour';
        }*/





        $params['groupe'] = $groupe;
        $params['menuPrincipal'] = $menuPrincipal;


        $stmt = $connection->executeQuery($sql, $params);

        return $stmt->fetchAllAssociative();
    }


    public function  afficheGroupe()
    {
        return $this->createQueryBuilder('m')
            ->select('g.id', 'g.titre', 'g.ordre', 'md.id')
            ->innerJoin('m.groupeModule', 'g')
            ->leftJoin('m.module', 'md')
            /* ->innerJoin('m.module','md')*/
            /* ->groupBy('g.id')*/
            ->orderBy('g.ordre', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return ModuleGroupePermition[] Returns an array of ModuleGroupePermition objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ModuleGroupePermition
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
