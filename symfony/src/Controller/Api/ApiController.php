<?php

namespace App\Controller\Api;

use App\Service\ArrayDivider\ICanDivide;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController.
 * Методы API
 *
 * @package App\Controller\Api
 */
class ApiController
{
    private $service;

    public function __construct(ICanDivide $service)
    {
        $this->service = $service;
    }

    /**
     * Рабочий роут /divider для доступа к рабочему методу сервиса
     *
     * @Route("/api/divider", name="app_api_divider")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getDivide(Request $request): JsonResponse
    {
        return JsonResponse::create(['result' => $this->service->divide(0, [])]);
    }
}