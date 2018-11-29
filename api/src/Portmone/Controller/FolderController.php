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
use App\Portmone\Entity\FolderEntity;

class FolderController extends Controller
{
    /**
     * @Route("/folder", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createFolder(Request $request)
    {
        try {
            $entityManager = $this->getDoctrine()->getManager();
            $folder = FolderEntity::deserialize($request->request->all());

            //if (get_class($folder) != FolderEntity::class){
            if (!$folder instanceof FolderEntity){
                return new JsonResponse(['errors' => $folder], 400);
            }
            $entityManager->persist($folder);
            $entityManager->flush();
            return new JsonResponse(['msg' => 'Folder has been created successfully'], 201);
        } catch (UniqueConstraintViolationException $e){
            return new JsonResponse(['error' => "This name is already used"] , 400);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @Route("/folder/{id}", methods="PUT")
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateFolder(Request $request, int $id) : Response
    {
        try {
            $entityManager = $this->getDoctrine()->getManager();
            $folder = $entityManager->find(FolderEntity::class, $id);
            if (!$folder) {
                throw new NotFoundHttpException(
                    'No folder found with id '.$id
                );
            }
            $nameFolder = $request->get('nameFolder');
            if (!isset($nameFolder)) {
                throw new BadRequestHttpException('Name folder shouldn`t be empty');
            }
            $folder->setName($nameFolder);

            $folder = FolderEntity::deserialize($folder->serialize());
            if (!$folder instanceof FolderEntity){
                return new JsonResponse(['errors' => $folder], 400);
            }
            $entityManager->flush();
            return new JsonResponse(['msg' =>'Folder has been updated successfully'], 200);
        } catch (UniqueConstraintViolationException $e){
            return new JsonResponse(['error' => 'This name is already used'], 400);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @Route("/folder/{id}", methods={"DELETE"})
     * @param int $id
     * @return Response
     */
    public function deleteFolder(int $id) : Response
    {

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $folder = $entityManager->find(FolderEntity::class, $id);
            if (!$folder) {
                throw new NotFoundHttpException(
                    'No folder found with id '.$id
                );
            }
            $entityManager->remove($folder);
            $entityManager->flush();

            return new JsonResponse(['msg' => 'Folder has been deleted successfully'], 200);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
//
//    private function fail(\Exception $e)
//    {
//        return new JsonResponse(['error' => $e->getMessage()], 500);
//    }
}
