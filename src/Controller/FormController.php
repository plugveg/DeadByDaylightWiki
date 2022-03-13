<?php

namespace App\Controller;

use App\Entity\Perks;
use APP\Entity\Survivors;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/form")
 */
class FormController extends AbstractController
{

    /**
     * @Route("/perk", name="form_perk")
     */
    public function index(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $perks = $em->getRepository(Perks::class)->findAll();

        $survivors = $em->getRepository(Survivors::class)->findAll();
        dump($em->getRepository(Survivors::class)->findAll());


        $perks = new Perks();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $perks->setPerkName($data["perk_name"]);
            $perks->setPerkImage($data["perk_image"]);
            $perks->setPerkExplanation($data["perk_explanation"]);
            $perks->setPerkSurvivor($data["perk_survivor_id"]);
            $em->persist($perks);
            $em->flush();
            $msg = "Perks ajoutée avec succés";
        }

        return $this->render('form/index.html.twig', [
            "msg"=>$msg,
            'perks' => $perks,
            'survivors' => $survivors,
        ]);
    }
}
