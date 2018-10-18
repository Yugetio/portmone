<?php

namespace App\Portmone\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\TokenModel;
use App\Portmone\Form\Forma;

class TokenController extends Controller
{
    public function indexAction(Request $request)
    {
        $userSearch = new TokenModel();

        $form = $this->createForm(Forma::class, $userSearch);
        $form->handleRequest($request);

        $userSearch = $form->getData();

        $elasticaManager = $this->get('fos_elastica.manager');
        $results = $elasticaManager->getRepository('Portmone:TokenEntity')->searchUser($userSearch);


    }

}