<?php


namespace App\Infrastructure\Controller;


use App\Application\Auth\Login\LoginCommand;
use App\Application\Auth\Login\LoginUseCase;

use App\Domain\Neighbour\Exceptions\NeighbourNotFoundByEmail;
use App\Domain\Neighbour\Exceptions\NeighbourWrongPassword;

use App\Infrastructure\Api\Response\Auth\BadCredentialsResponse;
use App\Infrastructure\Api\Response\Auth\SuccessLoginResponse;
use App\Infrastructure\Security\Jwt\JwtNeighbourParser;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends BaseController
{
    /**
     * @var JwtNeighbourParser
     */
    private JwtNeighbourParser $jwtNeighbourParser;
    /**
     * @var JWTTokenManagerInterface
     */
    private JWTTokenManagerInterface $jwtTokenManager;

    /**
     * AuthController constructor.
     * @param JwtNeighbourParser $jwtNeighbourParser
     * @param JWTTokenManagerInterface $jwtTokenManager
     */
    public function __construct(JwtNeighbourParser $jwtNeighbourParser, JWTTokenManagerInterface $jwtTokenManager)
    {
        $this->jwtNeighbourParser = $jwtNeighbourParser;
        $this->jwtTokenManager = $jwtTokenManager;
    }

    /**
     * @Route("/auth/login", methods="POST", name="auth_login")
     *
     * @param Request $req
     * @param LoginUseCase $loginUseCase
     * @return JsonResponse
     */
    public function login(Request $req, LoginUseCase $loginUseCase): JsonResponse
    {
        $email = $req->request->get('email');
        $password = $req->request->get('password');

        $command = new LoginCommand($email, $password);

        try {
            $useCaseResponse = $loginUseCase->login($command);

            if (is_null($useCaseResponse->getNeighbour())) {
                $response = new BadCredentialsResponse();
                return $this->response($response);
            }

            $jwtNeighbour = $this->jwtNeighbourParser->toJwtPayload($useCaseResponse->getNeighbour());

            $token = $this->jwtTokenManager->createFromPayload($jwtNeighbour, $jwtNeighbour->getPayload());

            $response = new SuccessLoginResponse($token);
            return $this->response($response);
        } catch (NeighbourNotFoundByEmail | NeighbourWrongPassword $e) {
            $response = new BadCredentialsResponse($e->getMessage());
            return $this->response($response);
        }
    }

}