<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/method.{name<\w+>}', name: 'api')]
    public function api(string $name, Request $request): Response
    {
        if ($name == "getUserMove"){
            $api_request['userMove'] = array(
                'User1' => true,
                'User2' => false,
                'GameToken' => $request->query->get('game_token')
            );
        }

        return new JsonResponse($api_request);

        // return $this->render('api/index.html.twig', [
        //     'json_api' => $api_request,
        // ]);
    }
}
