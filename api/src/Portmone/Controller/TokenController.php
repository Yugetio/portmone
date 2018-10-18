<?php

namespace App\Portmone\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\TokenEntity;
use App\Portmone\Form\Forma;

class TokenController extends Controller
{
    public function indexAction(Request $request)
    {
        $userSearch = new TokenEntity();

        $form = $this->createForm(Forma::class, $userSearch);
        $form->handleRequest($request);

        $userSearch = $form->getData();

        $elasticaManager = $this->get('fos_elastica.manager');
        $results = $elasticaManager->getRepository('AcmeUserBundle:User')->searchUser($userSearch);

        return $this->render('AcmeUserBundle:User:list.html.twig', [
            'form' => $form->createView(),
            'users' => $results
        ]);
    }

}