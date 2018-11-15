<?php

namespace App\Portmone\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\ElasticaBundle\Manager\RepositoryManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\CardEntity;




class CardController extends Controller
{
    /**
     * @Route("/card ", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createCard(Request $request)
    {

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $card = new CardEntity();
            $card->setFolderId($request->get('folderId'));
            $card->setNumber($request->get('number'));
            $card->setCash($request->get('cash'));
            $entityManager->persist($card);
            $entityManager->flush();

            return new JsonResponse(['msg' => 'Card has been created successfully'],201);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    /**
     * @Route("/card", methods="PUT")
     * @param Request $request
     * @return Response
     */
    public function updateCard(Request $request) : Response
    {

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $card = $entityManager->find(CardEntity::class, $request->get('id'));
            if (!$card) {
                throw $this->createNotFoundException(
                    'No card found for id '.$request->get('id')
                );
            }
            $card->setCash($request->get('cash'));
            $entityManager->flush();

            return new JsonResponse(['msg' =>'Card has been updated successfully'],200);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    /**
     * @Route("/card", methods="DELETE")
     * @param Request $request
     * @return Response
     */
    public function deleteCard(Request $request) : Response
    {

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $card = $entityManager->find(CardEntity::class, $request->get('id'));
            if (!$card) {
                throw $this->createNotFoundException(
                    'No card found for id '.$request->get('id')
                );
            }
            $entityManager->remove($card);
            $entityManager->flush();

            return new JsonResponse(['msg' => 'Card has been deleted successfully'],200);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }


}
