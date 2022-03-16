<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity et Form*/
use App\Entity\Killers;
use App\Form\KillersFormType;
/*Les use nécessaires pour lancer le code*/
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/*La route générale*/
/**
 * @Route("/killers")
 */
class KillersController extends AbstractController
{
    /*La route menant à la main page des Killers*/
    /**
     * @Route("/", name="killers")
     */
    /*Cette fonction renvoie à la main page du controller KillersController*/
    public function index(EntityManagerInterface $em): Response
    {
        /*Permet de récupérer toutes les entrées des killers dans la base de données*/
        $Killers = $em->getRepository(Killers::class)->findAll();

        /*Le rendu en HTML*/
        return $this->render('killers/index.html.twig', [
            'controller_name' => 'KillersController',
            'Killers' => $Killers,
        ]);
    }

    /*La route menant à la page read*/
    /**
     * @Route ("/{id}/read", name="killer_read")
     */
    /*Cette fonction renvoie à la page permettant de lire les differents Killers*/
    public function readPerks(ManagerRegistry $doctrine, int $id){
        /*Permet de récupérer toutes les entrées des killers selon leurs id dans la base de données*/
        $em = $doctrine->getManager();
        $killer = $em->getRepository(Killers::class)->find($id);

        /*Le rendu en HTML*/
        return $this->renderForm('killers/read.html.twig', [
            'killer' => $killer,
        ]);
    }

    /*La route menant à la pade d'edit*/
    /**
     * @Route("/{id}/edit", name="killers_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    /*Cette fonction renvoie au formulaire d'édition permettant de modifier ou de supprimer un Killer*/
    public function edit(Request $request, Killers $killers, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire d'edit*/
        $form = $this->createForm(KillersFormType::class, $killers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('killers', [], Response::HTTP_SEE_OTHER);
        }

        /*Le rendu en HTML*/
        return $this->renderForm('killers/edit.html.twig', [
            'killers' => $killers,
            'formkiller' => $form,
        ]);
    }

    /*La route menant à la fonction delete*/
    /**
     * @Route("/{id}", name="killers_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Killers $killers, EntityManagerInterface $entityManager): Response
    {
        /*Cette fonction n'a pas de twig car elle permet seulement la suppression d'un Tueur lorsque l'on clique sur le bouton 'Delete'
        dans le killers/edit.html.twig*/
        if ($this->isCsrfTokenValid('delete'.$killers->getId(), $request->request->get('_token'))) {
            $entityManager->remove($killers);
            $entityManager->flush();
        }

        return $this->redirectToRoute('killers', [], Response::HTTP_SEE_OTHER);
    }
}
