<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Perks;
use App\Entity\Survivors;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/survivors")
 */
class SurvivorsController extends AbstractController
{
    /**
     * @Route("/", name="survivors")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Survivors = $em ->getRepository(Survivors::class)->findAll();

        //foreach ($Survivors as $survivor) {
            //foreach($survivor->getSurvivorPerk1() as $toto){
                //dump($toto);
            //}
        //}


        return $this->render('survivors/index.html.twig', [
            'controller_name' => 'SurvivorsController',
            'Survivors' => $Survivors,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="survivor_read")
     */
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $survivor = $em->getRepository(Survivors::class)->find($id);

        return $this->renderForm('survivors/read.html.twig', [
            'survivor' => $survivor,
        ]);
    }
}
