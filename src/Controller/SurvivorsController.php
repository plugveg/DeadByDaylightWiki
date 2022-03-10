<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Perks;
use App\Entity\Survivors;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SurvivorsController extends AbstractController
{
    /**
     * @Route("/survivors", name="survivors")
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
}
