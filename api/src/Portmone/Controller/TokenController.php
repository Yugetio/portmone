<?php

namespace App\Portmone\Controller;

use FOS\ElasticaBundle\Manager\RepositoryManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\TokenModel;
use App\Portmone\Form\Forma;
use FOS\ElasticaBundle\Repository;
use Symfony\Component\Routing\Annotation\Route;

class TokenController extends Controller
{
    /**
     *@Route("/user", methods={"POST"})
     */

    public function indexAction(Request $request)
    {
//        $userSearch = new TokenModel();
//
//        $form = $this->createForm(Forma::class, $userSearch);
//        $form->handleRequest($request);
        var_dump($request);

//        $userSearch = $form->getData();
//
//        $elasticaManager = $this->get('fos_elastica.manager');
//        $results = $elasticaManager->getRepository('Portmone:TokenEntity')->searchUser($userSearch);
        return $request;

    }





}