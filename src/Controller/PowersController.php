<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity et Form*/
use App\Entity\Powers;
use App\Form\PowersFormType;
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
 * @Route("/powers")
 */
class PowersController extends AbstractController
{
    /*La route menant à la main page des Powers*/
    /**
     * @Route("/", name="powers")
     */
    /*Cette fonction renvoie à la main page du controller PowersController*/
    public function index(EntityManagerInterface $em): Response
    {
        /*Permet de récupérer toutes les entrées des powers dans la base de données*/
        $Powers = $em->getRepository(Powers::class)->findAll();

        /*Le rendu en HTML*/
        return $this->render('powers/index.html.twig', [
            'controller_name' => 'PowersController',
            'Powers' => $Powers,
        ]);
    }

    /*La route menant à la page read*/
    /**
     * @Route ("/{id}/read", name="powers_read")
     */
    /*Cette fonction renvoie à la page permettant de lire les differents Powers*/
    public function read(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();
        /*Permet de récupérer toutes les entrées des powers selon leurs id dans la base de données*/
        $power = $em->getRepository(Powers::class)->find($id);

        /*Le rendu en HTML*/
        return $this->renderForm('powers/read.html.twig', [
            'power' => $power,
        ]);
    }

    /*La route menant à la pade d'edit*/
    /**
     * @Route("/{id}/edit", name="powers_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    /*Cette fonction renvoie au formulaire d'édition permettant de modifier ou de supprimer un Power*/
    public function edit(Request $request, Powers $powers, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire d'edit*/
        $form = $this->createForm(PowersFormType::class, $powers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('powers', [], Response::HTTP_SEE_OTHER);
        }

        /*Le rendu en HTML*/
        return $this->renderForm('powers/edit.html.twig', [
            'powers' => $powers,
            'formpower' => $form,
        ]);
    }

    /*La route menant à la fonction delete*/
    /**
     * @Route("/{id}", name="powers_delete", methods={"GET", "POST"})
     */
    /*Cette fonction n'a pas de twig car elle permet seulement la suppression d'un Tueur lorsque l'on clique sur le bouton 'Delete'
    dans le powers/edit.html.twig*/
    public function delete(Request $request, Powers $powers, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$powers->getId(), $request->request->get('_token'))) {
            $entityManager->remove($powers);
            $entityManager->flush();
        }

        return $this->redirectToRoute('powers', [], Response::HTTP_SEE_OTHER);
    }
}
