<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Converter\FormatConverter;
use App\Entity\UserResult;
use App\Factory\EntityFactory;
use App\Service\ArrayDivider\ArrayDividerService;
use App\Service\ArrayDivider\ICanDivideArray;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ICanDivideArray $service, EntityManagerInterface $em)
    {
        $this->service = $service;
        $this->em = $em;

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
        try {
            $needleAsStr = $request->get('needle');
            $haystackAsString = $request->get('haystack');
            $result = $this->service->divide((int)$needleAsStr, FormatConverter::stringHaystackToArray($haystackAsString));
            $this->em->getRepository(UserResult::class)->storeResult(
                EntityFactory::makeUsersResult($this->getUser(), $needleAsStr, $haystackAsString, $result)
            );
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->json(['result' => $result,]);
    }
}