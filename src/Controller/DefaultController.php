<?php

namespace App\Controller;

use App\Service\NotionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var NotionService
     */
    private $notionService;

    public function __construct(NotionService $notionService)
    {
        $this->notionService = $notionService;
    }

    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {
        $pages = $this->notionService->getNotionPages();

        return $this->json($pages);
    }

    /**
     * @Route("/error", name="error")
     */
    public function error(): Response
    {
        return $this->json('nope.');
    }
}
