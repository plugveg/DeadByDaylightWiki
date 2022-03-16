<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity et Form*/
use App\Entity\Perks;
use App\Form\PerksFormType;
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
 * @Route("/perks")
 */
class PerksController extends AbstractController
{
    /*La route menant à la main page des Perks survivant*/
    /**
     * @Route("/", name="perks")
     */
    /*Cette fonction renvoie à la main page du controller PerksController*/
    public function index(EntityManagerInterface $em): Response
    {
        /*Permet de récupérer toutes les entrées des perks dans la base de données*/
        $Perks = $em->getRepository(Perks::class)->findAll();
/*        dump($Perks[0]->getPerkSurvivor()->getSurvivorName());*/

        /*Le rendu en HTML*/
        return $this->render('perks/index.html.twig', [
            'controller_name' => 'PerksController',
            'Perks' => $Perks,
        ]);
    }

    /*La route menant à la page read*/
    /**
     * @Route ("/{id}/read", name="perks_read")
     */
    /*Cette fonction renvoie à la page permettant de lire les differents Perks*/
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();
        /*Permet de récupérer toutes les entrées des perks selon leurs id dans la base de données*/
        $perk = $em->getRepository(Perks::class)->find($id);

        /*Le rendu en HTML*/
        return $this->renderForm('perks/read.html.twig', [
            'perk' => $perk,
        ]);
    }

    /*La route menant à la pade d'edit*/
    /**
     * @Route("/{id}/edit", name="perks_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    /*Cette fonction renvoie au formulaire d'édition permettant de modifier ou de supprimer une Perks*/
    public function edit(Request $request, Perks $perks, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire d'edit*/
        $form = $this->createForm(PerksFormType::class, $perks);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('perks', [], Response::HTTP_SEE_OTHER);
        }

        /*Le rendu en HTML*/
        return $this->renderForm('perks/edit.html.twig', [
            'perks' => $perks,
            'formperk' => $form,
        ]);
    }

    /*La route menant à la fonction delete*/
    /**
     * @Route("/{id}", name="perks_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Perks $perks, EntityManagerInterface $entityManager): Response
    {
        /*Cette fonction n'a pas de twig car elle permet seulement la suppression d'une Perk lorsque l'on clique sur le bouton 'Delete'
        dans le perks/edit.html.twig*/
        if ($this->isCsrfTokenValid('delete'.$perks->getId(), $request->request->get('_token'))) {
            $entityManager->remove($perks);
            $entityManager->flush();
        }

        return $this->redirectToRoute('perks', [], Response::HTTP_SEE_OTHER);
    }
}
