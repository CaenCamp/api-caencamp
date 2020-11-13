<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CaencampController extends AbstractController
{
    /**
     * @Route("/", name="caencamp")
     */
    public function index(): Response
    {
        return $this->json(['title' => "Caen.Camp's API"]);
    }
}
