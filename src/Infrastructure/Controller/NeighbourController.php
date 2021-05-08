<?php


namespace App\Infrastructure\Controller;


use App\Application\Neighbour\CreateNeighbour\CreateNeighbourCommand;
use App\Application\Neighbour\CreateNeighbour\CreateNeighbourUseCase;
use App\Domain\Exception\IdGenerationAttemptsExceeded;
use App\Domain\Neighbour\Exceptions\NeighbourEmailAlreadyInUse;
use App\Infrastructure\Api\Response\InternalServerErrorResponse;
use App\Infrastructure\Api\Response\Neighbour\NeighbourCreatedResponse;
use App\Infrastructure\Api\Response\Neighbour\NeighbourEmailAlreadyInUseResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NeighbourController
 *
 * @Route("/api")
 *
 * @package App\Infrastructure\Controller
 */
class NeighbourController extends BaseController
{

    /**
     * @Route("/neighbours", methods="POST", name="create_neighbour")
     * @param Request $req
     * @param CreateNeighbourUseCase $createNeighbourUseCase
     * @return JsonResponse
     */
    public function createNeighbour(Request $req, CreateNeighbourUseCase $createNeighbourUseCase): JsonResponse
    {
        $email = $req->request->get('email');
        $password = $req->request->get('password');
        $firstname = $req->request->get('firstname');
        $lastname = $req->request->get('lastname');

        $command = new CreateNeighbourCommand($email, $password, $firstname, $lastname);

        try {
            $useCaseResponse = $createNeighbourUseCase->create($command);

            $response = new NeighbourCreatedResponse($useCaseResponse->getNeighbour());
            return $this->response($response);
        } catch (NeighbourEmailAlreadyInUse $e) {
            $response = new NeighbourEmailAlreadyInUseResponse($e->getMessage());
            return $this->response($response);
        } catch (IdGenerationAttemptsExceeded | \Exception $e) {
            $response = new InternalServerErrorResponse($e->getMessage());
            return $this->response($response);
        }
    }

}