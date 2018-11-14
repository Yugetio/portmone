<?php
namespace App\Portmone\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Portmone\Entity\TransactionEntity;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Repository\TransactionEntityRepository;
use Elastica\Client;
use Elastica\Document;


class TransactionController
{

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/transaction", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createTransaction(Request $request)
    {
        try {
            $transactionId = substr(uniqid('', true), -6);

            $transaction = [
                'id' => $transactionId,
                'sourceCardId' => $request->get('sourceCardId'),
                'destinationCardId' => $request->get('destinationCardId'),
                'transferredMoney' => $request->get('money'),
                'date' => time()
            ];
            $transactionEntity = TransactionEntity::deserialize($transaction);
            $transactionDocument = new Document($id = '', $transactionEntity->serialize($transactionId));
            $elasticaType = $this->client->getIndex('portmone')->getType('transaction');
            $elasticaType->addDocument($transactionDocument);
            $elasticaType->getIndex()->refresh();

            return new JsonResponse(['msg' => 'Transaction has been created successfully'], 201);
        } catch (Exception $e) {
            return $this->fail($e);
        }
    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }
}
