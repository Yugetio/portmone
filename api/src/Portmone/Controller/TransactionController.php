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
use App\Repository\TransactionEntityRepository;


class TransactionController extends Controller
{

    /**
     * @var TransactionEntityRepository
     */
    private $transactionEntityRepository;

    public function __construct(TransactionEntityRepository $transactionEntityRepository)
    {
        $this->transactionEntityRepository = $transactionEntityRepository;
    }

    /**
     * @Route("/transaction", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createTransaction(Request $request)
    {
        try {
            $elasticaType = $this->transactionEntityRepository->ConnectToDB();

            $transactionId = substr(uniqid('', true), -6);

            $transaction = [
                'id' => $transactionId,
                'sourceCardId' => $request->get('sourceCardId'),
                'destinationCardId' => $request->get('destinationCardId'),
                'transferredMoney' => $request->get('money'),
                'date' => time()
            ];
            $transactionEntity = TransactionEntity::deserialize($transaction);
            $transactionDocument = new \Elastica\Document($id = '', $transactionEntity->serialize($transactionId));
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
