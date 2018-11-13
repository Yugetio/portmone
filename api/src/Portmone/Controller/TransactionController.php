<?php
namespace App\Portmone\Controller;

use Elastica\Processor\Date;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\TransactionEntity;
use Symfony\Component\Routing\Annotation\Route;
use Elasticsearch\ClientBuilder;
use Symfony\Component\Config\Definition\Exception\Exception;
//use Elastica\Document;


class TransactionController extends Controller
{
    /**
     * @Route("/transaction", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createTransaction(Request $request)
    {
        try {
//            $finder = $this->container->get('fos_elastica.finder.app.transaction');
//            $boolQuery = new \Elastica\Query\BoolQuery();
//
//            $folderQuery = new \Elastica\Query\Match();
//            $folderQuery->setFieldQuery('folder_id', 4);
//            $boolQuery->addShould($folderQuery);
//
//            $transferredMoneyQuery = new \Elastica\Query\Match();
//            $transferredMoneyQuery->setFieldQuery('transferredMoney', 99454);
//            $boolQuery->addShould($transferredMoneyQuery);
//
//            $dateQuery = new \Elastica\Query\Match();
//            $dateQuery->setFieldQuery('date', date("dmYHis"));
//            $boolQuery->addShould($dateQuery);


//            $client = ClientBuilder::create()->build();
//
//            $params = [
//                'index' => 'app',
//                'type' => 'transaction',
//                'body' => [
//                    'folderId' => 322,
//                    'transferredMoney' => 1232,
//                    'date' => new \DateTime()
//                ]
//            ];
//            $response = $client->index($params);




            $elasticaClient = new \Elastica\Client(
                [
                'servers' => [
                    [
                        'host' => 'elasticsearch',
                        'port' => 9200
                    ],
                ]
            ]);

            // Load index
            $elasticaIndex = $elasticaClient->getIndex('portmone');
            if (!$elasticaIndex->exists()){
                $elasticaIndex->create();
            }
            //Create a type
            $elasticaType = $elasticaIndex->getType('transaction');

            $mapping = new \Elastica\Type\Mapping();
            $mapping->setType($elasticaType);

            $mapping->setProperties([
                'id' => [
                    'type' => 'integer'
                ],
                'folderId' => [
                    'type' => 'integer'
                ],
                'transferredMoney' => [
                    'type' => 'float'
                ],
                'date' => [
                    'type' => 'date'
                ]
            ]);
            $mapping->send();

            $id = substr(uniqid('', true), -6);

            $transactionEntity = new TransactionEntity();
            $transactionEntity->setTransferredMoney($request->get("money"));
            $transactionEntity->setTransactionDate(date("dmYHis"));

            $transaction = [
                'id' => $id,
                'folderId' => $transactionEntity->getFolderId(),
                'transferredMoney' => $transactionEntity->getTransferredMoney(),
                'date' => $transactionEntity->getTransactionDate()
            ];
            $transactionDocument = new \Elastica\Document($id = '', $transaction);
            $elasticaType->addDocument($transactionDocument);
            $elasticaType->getIndex()->refresh();

            return new JsonResponse('Transaction has been created successfully', 201);
        } catch (Exception $e) {
            return $this->fail($e);
        }

    }

//    /**
//     * @Route("/folder", methods={"PUT"})
//     * @param Request $request
//     * @return Response
//     */
//    public function updateFolder(Request $request) : Response
//    {
//
//        try {
//            $data = json_decode($request->getContent(), true);
//            $entityManager = $this->getDoctrine()->getManager();
//            $folder = $entityManager->find(FolderEntity::class, $data['id']);
//            if (!$folder) {
//                throw $this->createNotFoundException(
//                    'No folder found for id '.$folder['id']
//                );
//            }
//            $folder->setName($data['nameFolder']);
//            $entityManager->flush();
//
//            return new JsonResponse(['folder update is successfully' => $folder['id']], 201);
//        }catch (Exception $e) {
//            return $this->fail($e);
//        }
//    }
//
//    /**
//     *@Route("/folder", methods={"DELETE"})
//     */
//    public function deleteFolder(Request $request) : Response
//    {
//
//        try {
//
//            $data = json_decode($request->getContent(), true);
//            $entityManager = $this->getDoctrine()->getManager();
//            $folder = $entityManager->find(FolderEntity::class, $data['id']);
//            if (!$folder) {
//                throw $this->createNotFoundException(
//                    'No folder found for id '.[$data['id']]
//                );
//            }
//            $entityManager->remove($folder);
//            $entityManager->flush();
//
//            return new JsonResponse(['Card deleted is successfully' => $data['id']], 201);
//        }catch (Exception $e) {
//            return $this->fail($e);
//        }
//    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }
}
