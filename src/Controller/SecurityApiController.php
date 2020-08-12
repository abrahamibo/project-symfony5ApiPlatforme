<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class SecurityApiController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        return $this->json([
                'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }

    public function JsonMe()
    {
        return JsonResponse::fromJsonString(
            $this->serializer->serialize($this->getUser(), 'jsonld', ['groups' => ['user:read', 'myself:read', 'user:item:read']]),
            200,
            ['Content-Type' => 'application/ld+json; charset=utf-8']
        );
    }

    /**
     * @Route("/me", name="app_me")
     */
    public function me()
    {
        if ($user = $this->getUser()) {
            return $this->JsonMe();
        } else {
            return $this->json([
                'error' => 'User not currently logged in'
            ], 401);
        }
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
