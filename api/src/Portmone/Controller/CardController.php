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
            $entityManager = $this->getDoctrine()->getManager();
            $user = new CardEntity();
            $user->setNumber($request->get('number'));
            $user->setCash($request->get('cash'));
            $entityManager->persist($user);
            $entityManager->flush();

            return new JsonResponse(['msg' => 'Card has been created successfully'],201);
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

            return new JsonResponse(['msg' =>'Card update is successfully'],201);
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

            return new JsonResponse(['msg' => 'Card deleted is successfully'],201);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }


}
