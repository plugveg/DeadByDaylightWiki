<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Killers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/killers")
 */
class KillersController extends AbstractController
{
    /**
     * @Route("/", name="killers")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Killers = $em->getRepository(Killers::class)->findAll();

        return $this->render('killers/index.html.twig', [
            'controller_name' => 'KillersController',
            'Killers' => $Killers,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="killer_read")
     */
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $killer = $em->getRepository(Killers::class)->find($id);

        return $this->renderForm('killers/read.html.twig', [
            'killer' => $killer,
        ]);
    }
}
