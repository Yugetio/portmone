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
use Elasticsearch\ClientBuilder;


class TransactionController extends Controller
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

    /**
     * @Route("/money", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function searchTransactionSameTransferredMoney(Request $request)
    {
        $client = $this->getSearchClient();
        $params = [
            'index' => 'portmone',
            'type' => 'transaction',
            'body' => [
                'query' => [
                    'match' => [
                        'transferredMoney' => $request->get('money')
                    ],
                ]
            ]
        ];
        $response = $client->search($params);

        return new JsonResponse($response);
    }

    /**
     * @Route("/money_great_than", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function searchTransactionGreatThanTransferredMoney(Request $request)
    {
        $client = $this->getSearchClient();
        $params = [
            'index' => 'portmone',
            'type' => 'transaction',
            'body' => [
                'query' => [
                    'range' => [
                        'transferredMoney' => [
                            'gt' => $request->get('money')],
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        return new JsonResponse($response);
    }


    /**
     * @Route("/date_after", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function searchTransactionOfDate(Request $request)
    {
        // example "date": "2018/11/16", "date": "2018-11-16",
        $requestDate = new \DateTime($request->get('date'));
        $requestTimestamp = $requestDate->getTimestamp();
        $client = $this->getSearchClient();
        $params = [
            'index' => 'portmone',
            'type' => 'transaction',
            'body' => [
                'query' => [
                    'range' => [
                        'date' =>[
                            'gt' => $requestTimestamp
                            ],
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        return new JsonResponse($response);
    }



    public function getSearchClient()
    {
        $hostName = [
            $_ENV['ELASTICSEARCH_HOST']
        ];
        $client = ClientBuilder::create()->setHosts($hostName)->build();

        return $client;
    }

    private function fail(\Exception $e)
    {
        return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }
}
