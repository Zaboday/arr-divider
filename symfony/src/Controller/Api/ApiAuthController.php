<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Service\PasswordEncoderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiAuthController.
 * Контроллер для Авторизации пользователей
 *
 * @package App\Controller\Api
 */
class ApiAuthController
{
    /**
     * @var \App\Repository\UserRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $repo;

    /**
     * @var PasswordEncoderService
     */
    private $encoder;

    public function __construct(EntityManagerInterface $em, PasswordEncoderService $encoderService)
    {
        $this->repo = $em->getRepository(User::class);
        $this->encoder = $encoderService;
    }

    /**
     * Метод проверяет логин/пароль и возвращает apiToken
     *
     * @Route("/api/authenticate", name="app_api_authenticate")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function authenticate(Request $request): JsonResponse
    {
        try {
            return JsonResponse::create(
                ['apiToken' => $this->repo->authenticate(
                    $request->query->get('email', ''),
                    $request->query->get('password', ''),
                    $this->encoder
                )]);
        } catch (\Exception $e) {
            return JsonResponse::create(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}