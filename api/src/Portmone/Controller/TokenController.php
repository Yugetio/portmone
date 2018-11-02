<?php

namespace App\Portmone\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\ElasticaBundle\Manager\RepositoryManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\TokenModel;
use Symfony\Component\Routing\Annotation\Route;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use Elastica\Query;
use FOS\ElasticaBundle\Repository;
use FOS\ElasticaBundle\Finder;
use Symfony\Component\Config\Definition\Exception\Exception;


class TokenController extends Repository
{
//    /**
//     *@Route("/token/user", methods={"POST"})
//     */
//
//    public function authentication(Request $request)
//    {
//        try {
//        $data = json_decode($request->getContent(), true);
//        var_dump($data);
//        $user = new TokenModel();
//
//        $finder = $this->container->get('fos_elastica.finder.app.token');
//        $results = $finder->find('refreshToken');
//        return $results;
//
//
//        return new JsonResponse(['Access Token created is successfully' => $user->getAccessToken()], 201);
//        }catch (Exception $e) {
//            return $this->fail($e);
//        }
//    }
//
//    /**
//     *@Route("/user", methods={"POST"})
//     */
//
//    public function searchUser(TokenModel $search)
//    {
//        $query = new BoolQuery();
//        if ($search->getId() != null && $search->getId() != '') {
//            $query->addMust(new Terms('id', [$search->getId()]));
//        }
//
//        $query = Query::create($query);
//
//        return $this->find($query);
//    }
}