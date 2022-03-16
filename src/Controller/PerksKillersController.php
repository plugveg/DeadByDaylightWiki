<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity et Form*/
use App\Entity\PerksKillers;
use App\Form\PerksKillersFormType;
/*Les use nécessaires pour lancer le code*/
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/*La route générale*/
/**
 * @Route("/perks_killers")
 */
class PerksKillersController extends AbstractController
{
    /*La route menant à la main page des Perks killers*/
    /**
     * @Route("/", name="perks_killers")
     */
    /*Cette fonction renvoie à la main page du controller PerksKillersController*/
    public function index(EntityManagerInterface $em): Response
    {
        /*Permet de récupérer toutes les entrées des perksKillers dans la base de données*/
        $PerksKillers = $em->getRepository(PerksKillers::class)->findAll();

        /*Le rendu en HTML*/
        return $this->render('perks_killers/index.html.twig', [
            'controller_name' => 'PerksKillersController',
            'PerksKillers' => $PerksKillers,
        ]);
    }

    /*La route menant à la page read*/
    /**
     * @Route ("/{id}/read", name="perkskillers_read")
     */
    /*Cette fonction renvoie à la page permettant de lire les differents PerksKillers*/
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();
        /*Permet de récupérer toutes les entrées des perksKillers selon leurs id dans la base de données*/
        $perkkiller = $em->getRepository(PerksKillers::class)->find($id);

        /*Le rendu en HTML*/
        return $this->renderForm('perks_killers/read.html.twig', [
            'perkkiller' => $perkkiller,
        ]);
    }

    /*La route menant à la pade d'edit*/
    /**
     * @Route("/{id}/edit", name="perkskillers_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    /*Cette fonction renvoie au formulaire d'édition permettant de modifier ou de supprimer une PerksKillers*/
    public function edit(Request $request, PerksKillers $perksKillers, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire d'edit*/
        $form = $this->createForm(PerksKillersFormType::class, $perksKillers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('perks_killers', [], Response::HTTP_SEE_OTHER);
        }

        /*Le rendu en HTML*/
        return $this->renderForm('perks_killers/edit.html.twig', [
            'perkskillers' => $perksKillers,
            'formperkkiller' => $form,
        ]);
    }

    /*La route menant à la fonction delete*/
    /**
     * @Route("/{id}", name="perkskillers_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, PerksKillers $perksKillers, EntityManagerInterface $entityManager): Response
    {
        /*Cette fonction n'a pas de twig car elle permet seulement la suppression d'une PerkKiller lorsque l'on clique sur le bouton 'Delete'
        dans le perks_killers/edit.html.twig*/
        if ($this->isCsrfTokenValid('delete'.$perksKillers->getId(), $request->request->get('_token'))) {
            $entityManager->remove($perksKillers);
            $entityManager->flush();
        }

        return $this->redirectToRoute('perks_killers', [], Response::HTTP_SEE_OTHER);
    }
}
