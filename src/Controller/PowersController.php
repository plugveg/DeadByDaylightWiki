<?php

namespace App\Controller;

use App\Entity\Powers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/powers")
 */
class PowersController extends AbstractController
{
    /**
     * @Route("/", name="powers")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Powers = $em->getRepository(Powers::class)->findAll();

        return $this->render('powers/index.html.twig', [
            'controller_name' => 'PowersController',
            'Powers' => $Powers,
        ]);
    }
}
