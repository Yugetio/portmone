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
     * @Route("/folder", methods={"POST"})
     */
    public function createFolder(Request $request)
    {

        try {
            $data = json_decode($request->getContent(), true);
            var_dump($data);
            $entityManager = $this->getDoctrine()->getManager();
            $folder = new FolderEntity();
            $folder->setName($data['nameFolder']);
            $entityManager->persist($folder);
            $entityManager->flush();


            return new JsonResponse(['Folder created is successfully' => $folder->getId()], 201);
        }catch (Exception $e) {
            return $this->fail($e);
        }

    }

    /**
     *@Route("/folder", methods={"PUT"})
     */
    public function updateFolder(Request $request) : Response
    {

        try {
            $data = json_decode($request->getContent(), true);
            $entityManager = $this->getDoctrine()->getManager();
            $folder = $entityManager->find(FolderEntity::class, $data['id']);
            if (!$folder) {
                throw $this->createNotFoundException(
                    'No folder found for id '.$folder['id']
                );
            }
            $folder->setName($data['nameFolder']);
            $entityManager->flush();

            return new JsonResponse(['folder update is successfully' => $folder['id']], 201);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    /**
     *@Route("/folder", methods={"DELETE"})
     */
    public function deleteFolder(Request $request) : Response
    {

        try {

            $data = json_decode($request->getContent(), true);
            $entityManager = $this->getDoctrine()->getManager();
            $folder = $entityManager->find(FolderEntity::class, $data['id']);
            if (!$folder) {
                throw $this->createNotFoundException(
                    'No folder found for id '.[$data['id']]
                );
            }
            $entityManager->remove($folder);
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
