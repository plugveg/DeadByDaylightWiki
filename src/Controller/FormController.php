<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity*/
use App\Entity\Perks;
use App\Entity\Survivors;
use App\Entity\Killers;
use App\Entity\PerksKillers;
use App\Entity\Maps;
use App\Entity\Powers;
use App\Entity\Weapons;
use App\Entity\User;
/*Les use nécessaires pour lancer le code*/
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/*La route générale*/
/**
 * @Route("/form")
 */
class FormController extends AbstractController
{
/*Ces formulaires permettent de créer de
nouvelles entrées dans la base de données*/
    /*La route menant au formulaire de création d'une perk survivant*/
    /**
     * @Route("/perk", name="form_perk")
     */
    public function index(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        /*Les deux lignes permettant d'accéder à l'Entity Perks*/
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
            $em->persist($perks); /*Envoie des infos dans la base de données*/
            $em->flush();/*La chasse d'eau*/
            $msg = "Perk ajoutée avec succés";
        }

        /*Le rendu en HTML*/
        return $this->render('form/indexperk.html.twig', [
            "msg"=>$msg,
            'perks' => $perks,
/*            'survivors'=>$Survivors,*/
        ]);
    }

    /*La route menant au formulaire de création d'un survivant*/
    /**
     * @Route("/survivor", name="form_survivor")
     */
    public function indexsurvivor(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        /*Les deux lignes permettant d'accéder à l'Entity Survivors*/
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
            $em->persist($survivors);/*Envoie des infos dans la base de données*/
            $em->flush();/*La chasse d'eau*/
            $msg = "Survivor ajouté avec succés";
        }

        /*Le rendu en HTML*/
        return $this->render('form/indexsurv.html.twig', [
            "msg"=>$msg,
            'survivors' => $survivors,
        ]);
    }

    /*La route menant au formulaire de création d'un tueur*/
    /**
     * @Route("/killer", name="form_killer")
     */
    public function indexkiller(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        /*Les deux lignes permettant d'accéder à l'Entity Killers*/
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
            $em->persist($killers);/*Envoie des infos dans la base de données*/
            $em->flush();/*La chasse d'eau*/
            $msg = "Killer ajouté avec succés";
        }

        /*Le rendu en HTML*/
        return $this->render('form/indexkiller.html.twig', [
            "msg"=>$msg,
            'killers' => $killers,
        ]);
    }

    /*La route menant au formulaire de création d'une perk tueur*/
    /**
     * @Route("/perk_killer", name="form_perkkiller")
     */
    public function indexPerkKiller(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        /*Les deux lignes permettant d'accéder à l'Entity PerksKillers*/
        $em = $doctrine->getManager();
        $perkskillers = $em->getRepository(PerksKillers::class)->findAll();

        $perkskillers = new PerksKillers();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $perkskillers->setPerkkillerName($data["perk_name"]);
            $perkskillers->setPerkkillerImage($data["perk_image"]);
            $perkskillers->setPerkkillerExplanation($data["perk_explanation"]);
            $em->persist($perkskillers);/*Envoie des infos dans la base de données*/
            $em->flush();/*La chasse d'eau*/
            $msg = "Perk Killer ajoutée avec succés";
        }

        /*Le rendu en HTML*/
        return $this->render('form/indexperkkiller.html.twig', [
            "msg"=>$msg,
            'perkskillers' => $perkskillers,
        ]);
    }

    /*La route menant au formulaire de création d'une map*/
    /**
     * @Route("/map", name="form_map")
     */
    public function indexmap(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        /*Les deux lignes permettant d'accéder à l'Entity Maps*/
        $em = $doctrine->getManager();
        $maps = $em->getRepository(Maps::class)->findAll();

        $maps = new Maps();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $maps->setMapName($data["map_name"]);
            $maps->setMapImage($data["map_image"]);
            $maps->setMapDescription($data["map_description"]);
            $maps->setMapLayout($data["map_layout"]);
            $em->persist($maps);/*Envoie des infos dans la base de données*/
            $em->flush();/*La chasse d'eau*/
            $msg = "Map ajoutée avec succés";
        }

        /*Le rendu en HTML*/
        return $this->render('form/indexmap.html.twig', [
            "msg"=>$msg,
            'maps' => $maps,
        ]);
    }

    /*La route menant au formulaire de création d'un power*/
    /**
     * @Route("/power", name="form_power")
     */
    public function indexpower(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        /*Les deux lignes permettant d'accéder à l'Entity Powers*/
        $em = $doctrine->getManager();
        $powers = $em->getRepository(Powers::class)->findAll();

        $powers = new Powers();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $powers->setPowerName($data["power_name"]);
            $powers->setPowerImage($data["power_image"]);
            $powers->setPowerDescription($data["power_description"]);
            $powers->setPowerExplanation($data["power_explanation"]);
            $em->persist($powers);/*Envoie des infos dans la base de données*/
            $em->flush();/*La chasse d'eau*/
            $msg = "Power ajouté avec succés";
        }

        /*Le rendu en HTML*/
        return $this->render('form/indexpower.html.twig', [
            "msg"=>$msg,
            'powers' => $powers,
        ]);
    }

    /*La route menant au formulaire de création d'un weapon*/
    /**
     * @Route("/weapon", name="form_weapon")
     */
    public function indexweapon(Request $request, EntityManagerInterface $em, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        /*Les deux lignes permettant d'accéder à l'Entity Weapons*/
        $em = $doctrine->getManager();
        $weapons = $em->getRepository(Weapons::class)->findAll();

        $weapons = new Weapons();
        $msg = "";
        $data=$request->request->all();
        if(count($data)){
            $weapons->setWeaponName($data["weapon_name"]);
            $weapons->setWeaponImage($data["weapon_image"]);
            $weapons->setWeaponDescription($data["weapon_description"]);
            $em->persist($weapons);/*Envoie des infos dans la base de données*/
            $em->flush();/*La chasse d'eau*/
            $msg = "Weapon ajouté avec succés";
        }

        /*Le rendu en HTML*/
        return $this->render('form/indexweapon.html.twig', [
            "msg"=>$msg,
            'weapons' => $weapons,
        ]);
    }

}
