<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PerksKillers;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/perks_killers")
 */
class PerksKillersController extends AbstractController
{
    /**
     * @Route("/", name="perks_killers")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $PerksKillers = $em->getRepository(PerksKillers::class)->findAll();

        return $this->render('perks_killers/index.html.twig', [
            'controller_name' => 'PerksKillersController',
            'PerksKillers' => $PerksKillers,
        ]);
    }
}
