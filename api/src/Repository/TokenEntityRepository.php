<?php

namespace App\Repository;

use FOS\ElasticaBundle\Repository;
use App\Portmone\Entity\TokenModel;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use Elastica\Query;

class TokenEntityRepository extends Repository
{

    public function searchUser(TokenModel $search)
    {
        $query = new BoolQuery();
        if ($search->getId() != null && $search->getId() != '') {
            $query->addMust(new Terms('id', [$search->getId()]));
        }


        $query = Query::create($query);

        return $this->find($query);
    }
}