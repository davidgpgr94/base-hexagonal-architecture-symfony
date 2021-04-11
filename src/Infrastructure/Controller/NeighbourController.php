<?php


namespace App\Infrastructure\Controller;


use App\Application\Neighbour\CreateNeighbour\CreateNeighbourCommand;
use App\Application\Neighbour\CreateNeighbour\CreateNeighbourUseCase;
use App\Domain\Exception\IdGenerationAttemptsExceeded;
use App\Domain\Neighbour\Exceptions\NeighbourEmailAlreadyInUse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NeighbourController extends AbstractController
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
            $response = $createNeighbourUseCase->create($command);

            return $this->json(
                $response->getNeighbour(),
                Response::HTTP_CREATED
            );
        } catch (NeighbourEmailAlreadyInUse $e) {
            return $this->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (IdGenerationAttemptsExceeded | \Exception $e) {
            return $this->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}