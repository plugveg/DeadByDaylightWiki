<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity et Form*/
use App\Entity\Maps;
use App\Form\MapsFormType;
/*Les use nécessaires pour lancer le code*/
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/*La route générale*/
/**
 * @Route("/map")
 */
class MapController extends AbstractController
{
    /*La route menant à la main page des Maps*/
    /**
     *
     * @Route("/", name="maps")
     */
    /*Cette fonction renvoie à la main page du controller MapsController*/
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        /*Permet de récupérer toutes les entrées des maps dans la base de données*/
        $maps = $entityManager->getRepository(Maps::class)->findAll();

        /*Le rendu en HTML*/
        return $this->render('maps/index.html.twig',[
            'controller_name' => 'MapController',
            'Maps'=>$maps,
        ]);
    }

    /*La route menant à la page read*/
    /**
     * @Route ("/{id}/read", name="maps_read")
     */
    /*Cette fonction renvoie à la page permettant de lire les differentes maps*/
    public function read(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();
        /*Permet de récupérer toutes les entrées des maps selon leurs id dans la base de données*/
        $map = $em->getRepository(Maps::class)->find($id);

        /*Le rendu en HTML*/
        return $this->renderForm('maps/read.html.twig', [
            'map' => $map,
        ]);
    }

    /*La route menant à la pade d'edit*/
    /**
     * @Route("/{id}/edit", name="maps_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    /*Cette fonction renvoie au formulaire d'édition permettant de modifier ou de supprimer une Map*/
    public function edit(Request $request, Maps $maps, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire d'edit*/
        $form = $this->createForm(MapsFormType::class, $maps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('maps', [], Response::HTTP_SEE_OTHER);
        }

        /*Le rendu en HTML*/
        return $this->renderForm('maps/edit.html.twig', [
            'maps' => $maps,
            'formmap' => $form,
        ]);
    }

    /*La route menant à la fonction delete*/
    /**
     * @Route("/{id}", name="maps_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Maps $maps, EntityManagerInterface $entityManager): Response
    {
        /*Cette fonction n'a pas de twig car elle permet seulement la suppression d'une Map lorsque l'on clique sur le bouton 'Delete'
        dans le maps/edit.html.twig*/
        if ($this->isCsrfTokenValid('delete'.$maps->getId(), $request->request->get('_token'))) {
            $entityManager->remove($maps);
            $entityManager->flush();
        }

        return $this->redirectToRoute('maps', [], Response::HTTP_SEE_OTHER);
    }
}
