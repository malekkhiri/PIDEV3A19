<?php

namespace EvenementBundle\Repository;

/**
 * EvenementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EvenementRepository extends \Doctrine\ORM\EntityRepository
{
    function dateDQL()
    {
        $query=$this->getEntityManager()
            ->createQuery("select a from EvenementBundle:Evenement a 
                               
                                ORDER by a.dateDebut DESC ");
        return $query->getResult();
    }


}
