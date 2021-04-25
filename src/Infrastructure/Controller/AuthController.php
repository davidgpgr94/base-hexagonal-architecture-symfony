<?php


namespace App\Infrastructure\Controller;


use App\Application\Auth\Login\LoginCommand;
use App\Application\Auth\Login\LoginUseCase;

use App\Domain\Neighbour\Exceptions\NeighbourNotFoundByEmail;
use App\Domain\Neighbour\Exceptions\NeighbourWrongPassword;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{

    /**
     * @Route("/auth/login", methods="POST", name="auth_login")
     *
     * @param Request $req
     * @param LoginUseCase $loginUseCase
     * @return JsonResponse
     */
    public function login(Request $req, LoginUseCase $loginUseCase)
    {
        $email = $req->request->get('email');
        $password = $req->request->get('password');

        $command = new LoginCommand($email, $password);

        try {
            $response = $loginUseCase->login($command);

            return $this->json(
                $response->getNeighbour(),
                Response::HTTP_OK
            );
        } catch (NeighbourNotFoundByEmail $e) {
            return $this->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (NeighbourWrongPassword $e) {
            return $this->json(['message' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

}