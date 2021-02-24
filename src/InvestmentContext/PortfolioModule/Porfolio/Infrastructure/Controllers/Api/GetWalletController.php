<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Porfolio\Infrastructure\Controllers\Api;

use FinizensChallenge\SharedContext\HttpModule\Controller\Infrastructure\Controllers\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetWalletController extends AbstractApiController
{

    /** @Route ("/wallets") */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(['wiiiii' => 'jejejeje', 'req' => $request->getUri()]);
    }
}
