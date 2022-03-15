<?php

namespace App\Controller;

use App\Entity\Perks;
use App\Entity\Survivors;
use App\Entity\Killers;
use App\Entity\PerksKillers;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
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
/*Ces formulaires permettent de créer de
nouvelles entrées dans la base de données*/
    /**
     * @Route("/perk", name="form_perk")
     */
    public function index(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $perks = $em->getRepository(Perks::class)->findAll();

/*        $Survivors = $em->getRepository(Survivors::class)->findAll();
        dump($Survivors[0]);*/

        $perks = new Perks();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $perks->setPerkName($data["perk_name"]);
            $perks->setPerkImage($data["perk_image"]);
            $perks->setPerkExplanation($data["perk_explanation"]);
/*            $perks->setPerkSurvivor($data["perk_survivor_id"]);*/
            $em->persist($perks);
            $em->flush();
            $msg = "Perk ajoutée avec succés";
        }

        return $this->render('form/indexperk.html.twig', [
            "msg"=>$msg,
            'perks' => $perks,
/*            'survivors'=>$Survivors,*/
        ]);
    }

    /**
     * @Route("/survivor", name="form_survivor")
     */
    public function indexsurvivor(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $survivors = $em->getRepository(Survivors::class)->findAll();

        $survivors = new Survivors();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $survivors->setSurvivorName($data["survivor_name"]);
            $survivors->setSurvivorImage($data["survivor_image"]);
            $survivors->setSurvivorHistory($data["survivor_history"]);
            $survivors->setSurvivorSummary($data["survivor_summary"]);
            $em->persist($survivors);
            $em->flush();
            $msg = "Survivor ajouté avec succés";
        }

        return $this->render('form/indexsurv.html.twig', [
            "msg"=>$msg,
            'survivors' => $survivors,
        ]);
    }

    /**
     * @Route("/killer", name="form_killer")
     */
    public function indexkiller(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $killers = $em->getRepository(Killers::class)->findAll();

        $killers = new Killers();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $killers->setKillerNickname($data["killer_nickname"]);
            $killers->setKillerName($data["killer_name"]);
            $killers->setKillerImage($data["killer_image"]);
            $killers->setKillerSpeed($data["killer_speed"]);
            $killers->setKillerHistory($data["killer_history"]);
            $killers->setKillerSummary($data["killer_summary"]);
            $em->persist($killers);
            $em->flush();
            $msg = "Killer ajouté avec succés";
        }

        return $this->render('form/indexkiller.html.twig', [
            "msg"=>$msg,
            'killers' => $killers,
        ]);
    }

    /**
     * @Route("/perk_killer", name="form_perkkiller")
     */
    public function indexPerkKiller(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $perkskillers = $em->getRepository(PerksKillers::class)->findAll();

        $perkskillers = new PerksKillers();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $perkskillers->setPerkkillerName($data["perk_name"]);
            $perkskillers->setPerkkillerImage($data["perk_image"]);
            $perkskillers->setPerkkillerExplanation($data["perk_explanation"]);
            $em->persist($perkskillers);
            $em->flush();
            $msg = "Perk Killer ajoutée avec succés";
        }

        return $this->render('form/indexperkkiller.html.twig', [
            "msg"=>$msg,
            'perkskillers' => $perkskillers,
        ]);
    }
}
