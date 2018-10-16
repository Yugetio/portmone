<?php

namespace App\Repository;

use FOS\ElasticaBundle\Repository;

class TokenEntityRepository extends Repository
{
    public function findWithCustomQuery($searchText)
    {
        // build $query with Elastica objects
        //$this->find($query);
    }
}