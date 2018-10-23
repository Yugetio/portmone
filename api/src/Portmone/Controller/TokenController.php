<?php

namespace App\Portmone\Controller;

use FOS\ElasticaBundle\Manager\RepositoryManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\TokenModel;
use Symfony\Component\Routing\Annotation\Route;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use Elastica\Query;
use FOS\ElasticaBundle\Repository;

class TokenController extends Repository
{
    /**
     *@Route("/user", methods={"POST"})
     */

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