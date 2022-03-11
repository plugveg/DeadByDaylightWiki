<?php

namespace App\Controller;

use App\Entity\Weapons;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/weapons")
 */
class WeaponsController extends AbstractController
{
    /**
     * @Route("/", name="weapons")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Weapons = $em->getRepository(Weapons::class)->findAll();

        return $this->render('weapons/index.html.twig', [
            'controller_name' => 'WeaponsController',
            'Weapons' => $Weapons,
        ]);
    }
}
