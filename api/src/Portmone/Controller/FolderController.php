<?php

namespace App\Portmone\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\FolderEntity;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FolderController extends Controller
{
    public function validateFolderCredentials(FolderEntity $folder, ValidatorInterface $validator)
    {
        $folderErrors = $validator->validate($folder);
        $errors = [];
        if(count($folderErrors) > 0) {
            $errors['folderError'] = $folderErrors[0]->getMessage();
        }
        return $errors;
    }


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
        } catch (\Exception $e) {
            return $this->fail($e);
        }

    }

    /**
     * @Route("/folder/{id}", methods="PUT")
     * @param Request $request
     * @param int $id
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function updateFolder(Request $request, int $id, ValidatorInterface $validator) : Response
    {
        try {
            $entityManager = $this->getDoctrine()->getManager();
            $folder = $entityManager->find(FolderEntity::class, $id);
            if (!$folder) {
                throw $this->createNotFoundException(
                    'No folder found for id '.$id
                );
            }
            $folder->setName($request->get('nameFolder'));

            if($errors = $this->validateFolderCredentials($folder, $validator)) {
                return new JsonResponse($errors, 400);
            }
            $entityManager->flush();

            return new JsonResponse(['msg' =>'Folder has been updated successfully'], 200);
        }catch (Exception $e) {
            return $this->fail($e);
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
                throw $this->createNotFoundException(
                    'No folder found with id '.$id
                );
            }
            $entityManager->remove($folder);
            $entityManager->flush();

            return new JsonResponse(['msg' => 'Folder has been deleted successfully'], 200);
        }catch (Exception $e) {
            return $this->fail($e);
        }
    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }
}
