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
     *@Route("/card ", methods={"POST"})
     */
    public function createCard(Request $request)
    {

        try {
            $data = json_decode($request->getContent(), true);
            var_dump($data);
            $entityManager = $this->getDoctrine()->getManager();
            $user = new CardEntity();
            $user->setName($data['nameCard']);
            $user->setCash($data['cashMoney']);
            $entityManager->persist($user);
            $entityManager->flush();

            return new JsonResponse(['Card created is successfully' => $user->getId()], 201);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    /**
     *@Route("/file", methods={"PUT"})
     */
    public function updateCard(Request $request) : Response
    {

        try {
            $data = json_decode($request->getContent(), true);
            $entityManager = $this->getDoctrine()->getManager();
            $card = $entityManager->find(CardEntity::class, $data['id']);
            if (!$card) {
                throw $this->createNotFoundException(
                    'No card found for id '.$card['id']
                );
            }
            $card->setName($data['nameCard']);
            $card->setCash($data['cashMoney']);
            $entityManager->flush();

            return new JsonResponse(['Card update is successfully' => $card['id']], 201);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    /**
     *@Route("/file", methods={"DELETE"})
     */
    public function deleteCard(Request $request) : Response
    {

        try {

            $data = json_decode($request->getContent(), true);
            $entityManager = $this->getDoctrine()->getManager();
            $card = $entityManager->find(CardEntity::class, $data['id']);
            if (!$card) {
                throw $this->createNotFoundException(
                    'No card found for id '.[$data['id']]
                );
            }
            $entityManager->remove($card);
            $entityManager->flush();

            return new JsonResponse(['Card deleted is successfully' => $data['id']], 201);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }


}
