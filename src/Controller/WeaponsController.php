<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity et Form*/
use App\Entity\Weapons;
use App\Form\WeaponsFormType;
/*Les use nécessaires pour lancer le code*/
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/*La route générale*/
/**
 * @Route("/weapons")
 */
class WeaponsController extends AbstractController
{
    /*La route menant à la main page des Weapons*/
    /**
     * @Route("/", name="weapons")
     */
    /*Cette fonction renvoie à la main page du controller WeaponsController*/
    public function index(EntityManagerInterface $em): Response
    {
        /*Permet de récupérer toutes les entrées des powers dans la base de données*/
        $Weapons = $em->getRepository(Weapons::class)->findAll();

        /*Le rendu en HTML*/
        return $this->render('weapons/index.html.twig', [
            'controller_name' => 'WeaponsController',
            'Weapons' => $Weapons,
        ]);
    }

    /*La route menant à la page read*/
    /**
     * @Route ("/{id}/read", name="weapons_read")
     */
    /*Cette fonction renvoie à la page permettant de lire les differents Weapons*/
    public function read(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();
        /*Permet de récupérer toutes les entrées des weapons selon leurs id dans la base de données*/
        $weapon = $em->getRepository(Weapons::class)->find($id);

        /*Le rendu en HTML*/
        return $this->renderForm('weapons/read.html.twig', [
            'weapon' => $weapon,
        ]);
    }

    /*La route menant à la pade d'edit*/
    /**
     * @Route("/{id}/edit", name="weapons_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    /*Cette fonction renvoie au formulaire d'édition permettant de modifier ou de supprimer un Weapon*/
    public function edit(Request $request, Weapons $weapons, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire d'edit*/
        $form = $this->createForm(WeaponsFormType::class, $weapons);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('weapons', [], Response::HTTP_SEE_OTHER);
        }

        /*Le rendu en HTML*/
        return $this->renderForm('weapons/edit.html.twig', [
            'weapons' => $weapons,
            'formweapon' => $form,
        ]);
    }

    /*La route menant à la fonction delete*/
    /**
     * @Route("/{id}", name="weapons_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Weapons $weapons, EntityManagerInterface $entityManager): Response
    {
        /*Cette fonction n'a pas de twig car elle permet seulement la suppression d'un Tueur lorsque l'on clique sur le bouton 'Delete'
        dans le weapons/edit.html.twig*/
        if ($this->isCsrfTokenValid('delete'.$weapons->getId(), $request->request->get('_token'))) {
            $entityManager->remove($weapons);
            $entityManager->flush();
        }

        return $this->redirectToRoute('weapons', [], Response::HTTP_SEE_OTHER);
    }
}
