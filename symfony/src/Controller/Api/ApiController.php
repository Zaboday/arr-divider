<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Service\ArrayDivider\ArrayDividerService;
use App\Service\ArrayDivider\ICanDivideArray;
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
    /** @var ArrayDividerService */
    private $service;

    public function __construct(ICanDivideArray $service)
    {
        $this->service = $service;
    }

    /**
     * Рабочий роут /divide для доступа к рабочему методу сервиса
     *
     * @Route("/api/divide", name="app_api_divide")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getDivide(Request $request): JsonResponse
    {
        $result = $this->service->divide(5, [5, 5, 1, 7, 2, 3, 5]);
        return JsonResponse::create([
                'result' => $result,
            ]
        );
    }
}