<?php

namespace App\Controller;

use App\Service\GotenbergService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class GotenbergController extends AbstractController
{
    #[Route('/gotenberg', name: 'app_gotenberg', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        GotenbergService $gotenbergService,
    ): Response
    {
        $url = $request->request->get('url');

        if (!$url) {
            return new Response('URL is required.', Response::HTTP_BAD_REQUEST);
        }

        $response = $gotenbergService->convert($url);

        return new Response($response->getContent());
    }
}
