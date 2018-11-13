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

            $transactionId = substr(uniqid('', true), -6);

            $transaction = [
                'id' => $transactionId,
                'transferredMoney' => $request->get("money"),
                'date' => time()
            ];
            $transactionEntity = TransactionEntity::deserialize($transaction);
            $transactionDocument = new \Elastica\Document($id = '', $transactionEntity->serialize($transactionId));
            $elasticaType->addDocument($transactionDocument);
            $elasticaType->getIndex()->refresh();

            return new JsonResponse('Transaction has been created successfully', 201);
        } catch (Exception $e) {
            return $this->fail($e);
        }
    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }
}
