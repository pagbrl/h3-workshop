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
        return $this->json("Hello World !");
    }

    /**
     * @Route("/pages", name="pages")
     */
    public function listPages(): Response
    {
        $pages = $this->notionService->getPagesList();
        return $this->json($pages);
    }
}
