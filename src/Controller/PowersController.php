<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PowersController extends AbstractController
{
    /**
     * @Route("/powers", name="powers")
     */
    public function index(): Response
    {
        return $this->render('powers/index.html.twig', [
            'controller_name' => 'PowersController',
        ]);
    }
}
