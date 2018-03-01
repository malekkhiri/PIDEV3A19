<?php

namespace VenteLibreBundle\Repository;
use Doctrine\ORM\EntityRepository;

class AnnoncesRepository extends EntityRepository
{
    public function FindmyAnnonces($id_user){
        $qb=$this->createQueryBuilder('r')->where("r.user = :id_user")
            ->setParameters(array("id_user"=>$id_user));
        return $qb->getQuery()->getResult();
    }




}

