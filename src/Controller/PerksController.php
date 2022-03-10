<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerksController extends AbstractController
{
    /**
     * @Route("/perks", name="perks")
     */
    public function index(): Response
    {
        return $this->render('perks/index.html.twig', [
            'controller_name' => 'PerksController',
        ]);
    }
}
