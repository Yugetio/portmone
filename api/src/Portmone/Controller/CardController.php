<?php

namespace App\Portmone\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            $card = CardEntity::deserialize($request->request->all());

            if (!$card instanceof CardEntity){
                return new JsonResponse(['errors' => $card], 400);
            }
            $entityManager->persist($card);
            $entityManager->flush();

            return new JsonResponse(['msg' => 'Card has been created successfully'],201);
        } catch (UniqueConstraintViolationException $e) {
            return new JsonResponse(['error' => "This card is already used"], 400);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @Route("/card/{id}", methods="PUT")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateCard(Request $request, int $id) : Response
    {
        try {
            $entityManager = $this->getDoctrine()->getManager();
            $card = $entityManager->find(CardEntity::class, $id);
            if (!$card) {
                throw new NotFoundHttpException(
                    'No card found for id '.$id
                );
            }
            $cash = $request->get('cash');
            if (!isset($cash)) {
                throw new BadRequestHttpException('Cash folder shouldn`t be empty');
            }
            $card->setCash($cash);

            $card = CardEntity::deserialize($card->serialize());
            if (!$card instanceof CardEntity){
                return new JsonResponse(['errors' => $card], 400);
            }
            $entityManager->flush();

            return new JsonResponse(['msg' =>'Card has been updated successfully'],200);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 404);
        }catch (UniqueConstraintViolationException $e) {
            return new JsonResponse(['error' => "This card is already used"], 400);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @Route("/card/{id}", methods="DELETE")
     * @param int $id
     * @return Response
     */
    public function deleteCard(int $id) : Response
    {

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $card = $entityManager->find(CardEntity::class, $id);
            if (!$card) {
                throw new NotFoundHttpException(
                    'No card found for id '.$id
                );
            }
            $entityManager->remove($card);
            $entityManager->flush();

            return new JsonResponse(['msg' => 'Card has been deleted successfully'],200);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

}
