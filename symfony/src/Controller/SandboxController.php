<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SandboxController
 * Controller just for health check.
 *
 * @package App\Controller
 */
class SandboxController
{
    /**
     * @Route("/sandbox", name="app_get_sandbox")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function get(Request $request)
    {
        //$this->('app.service.user_password_encoder')
        return JsonResponse::create(['result' => 'ok', 'message' => 'This just sandbox method']);
    }
}