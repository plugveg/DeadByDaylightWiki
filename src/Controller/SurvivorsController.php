<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity et Form*/
use App\Entity\Survivors;
use App\Form\SurvivorsFormType;
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
 * @Route("/survivors")
 */
class SurvivorsController extends AbstractController
{
    /*La route menant à la main page des Survivors*/
    /**
     * @Route("/", name="survivors")
     */
    /*Cette fonction renvoie à la main page du controller SurvivorsController*/
    public function index(EntityManagerInterface $em): Response
    {
        /*Permet de récupérer toutes les entrées des survivors dans la base de données*/
        $Survivors = $em ->getRepository(Survivors::class)->findAll();

        //foreach ($Survivors as $survivor) {
            //foreach($survivor->getSurvivorPerk1() as $toto){
                //dump($toto);
            //}
        //}

        /*Le rendu en HTML*/
        return $this->render('survivors/index.html.twig', [
            'controller_name' => 'SurvivorsController',
            'Survivors' => $Survivors,
        ]);
    }

    /*La route menant à la page read*/
    /**
     * @Route ("/{id}/read", name="survivors_read")
     */
    /*Cette fonction renvoie à la page permettant de lire les differents Survivors*/
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();
        /*Permet de récupérer toutes les entrées des survivors selon leurs id dans la base de données*/
        $survivor = $em->getRepository(Survivors::class)->find($id);

        /*Le rendu en HTML*/
        return $this->renderForm('survivors/read.html.twig', [
            'survivor' => $survivor,
        ]);
    }

    /*La route menant à la pade d'edit*/
    /**
     * @Route ("/{id}/edit", name="survivors_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    /*Cette fonction renvoie au formulaire d'édition permettant de modifier ou de supprimer un Survivor*/
    public function edit(Request $request, Survivors $survivors, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire d'edit*/
        $form = $this->createForm(SurvivorsFormType::class, $survivors);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('survivors', [], Response::HTTP_SEE_OTHER);
        }

        /*Le rendu en HTML*/
        return $this->renderForm('survivors/edit.html.twig', [
            'survivors' => $survivors,
            'formsurv' => $form,
        ]);
    }

    /*La route menant à la fonction delete*/
    /**
     * @Route("/{id}", name="survivors_delete", methods={"GET", "POST"})
     */
    /*Cette fonction n'a pas de twig car elle permet seulement la suppression d'un Tueur lorsque l'on clique sur le bouton 'Delete'
    dans le survivors/edit.html.twig*/
    public function delete(Request $request, Survivors $survivors, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$survivors->getId(), $request->request->get('_token'))) {
            $entityManager->remove($survivors);
            $entityManager->flush();
        }

        return $this->redirectToRoute('survivors', [], Response::HTTP_SEE_OTHER);
    }
}
