<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeaponsController extends AbstractController
{
    /**
     * @Route("/weapons", name="weapons")
     */
    public function index(): Response
    {
        return $this->render('weapons/index.html.twig', [
            'controller_name' => 'WeaponsController',
        ]);
    }
}
