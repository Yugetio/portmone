<?php

namespace App\Portmone\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\ElasticaBundle\Manager\RepositoryManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\FolderEntity;
use Symfony\Component\Config\Definition\Exception\Exception;

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
            $folder = new FolderEntity();
            $folder->setName($request->get('nameFolder'));
            $entityManager->persist($folder);
            $entityManager->flush();
            return new JsonResponse('Folder has been created successfully', 201);
        } catch (Exception $e) {
            return $this->fail($e);
        }

    }

    /**
     * @Route("/folder", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function updateFolder(Request $request) : Response
    {

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $folder = $entityManager->find(FolderEntity::class, $request->get('id'));
            if (!$folder) {
                throw $this->createNotFoundException(
                    'No folder found for id '.$folder['id']
                );
            }
            $folder->setName($request->get('nameFolder'));
            $entityManager->flush();

            return new JsonResponse('Folder has been updated successfully', 200);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    /**
     * @Route("/folder", methods={"DELETE"})
     * @param Request $request
     * @return Response
     */
    public function deleteFolder(Request $request) : Response
    {

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $folder = $entityManager->find(FolderEntity::class, $request->get('id'));
            if (!$folder) {
                throw $this->createNotFoundException(
                    'No folder found with id '.$request->get('id')
                );
            }
            $entityManager->remove($folder);
            $entityManager->flush();

            return new JsonResponse('Folder has been deleted successfully', 200);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }
}
