<?php

namespace App\Controller\api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class DefaultApiController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->json([
                'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }
}
