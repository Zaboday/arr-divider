<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Converter\FormatConverter;
use App\Service\ArrayDivider\ArrayDividerService;
use App\Service\ArrayDivider\ICanDivideArray;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController.
 * Методы API
 *
 * @package App\Controller\Api
 */
class ApiController extends AbstractController
{
    /** @var ArrayDividerService */
    private $service;

    public function __construct(ICanDivideArray $service)
    {
        $this->service = $service;
    }

    /**
     * Рабочий роут /divide для доступа к методу сервиса
     *
     * @Route("/api/divide", methods={"POST"}, name="app_api_divide")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function postDivide(Request $request): JsonResponse
    {
        $needle = $request->get('needle');
        $haystackAsString = $request->get('haystack');
        $result = $this->service->divide((int)$needle, FormatConverter::stringHaystackToArray($haystackAsString));

        return $this->json(['result' => $result,]);
    }
}