<?php

namespace App\Controller;

use App\Entity\Maps;
use App\Form\MapsFormType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 *
 * @Route("/map")
 */
class MapController extends AbstractController
{
    /**
     *
     * @Route("/", name="maps")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $maps = $entityManager->getRepository(Maps::class)->findAll();

        return $this->render('maps/index.html.twig',[
            'controller_name' => 'MapController',
            'Maps'=>$maps,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="maps_read")
     */
    public function read(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $map = $em->getRepository(Maps::class)->find($id);

        return $this->renderForm('maps/read.html.twig', [
            'map' => $map,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="maps_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Maps $maps, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MapsFormType::class, $maps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('maps', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maps/edit.html.twig', [
            'maps' => $maps,
            'formmap' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="maps_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Maps $maps, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maps->getId(), $request->request->get('_token'))) {
            $entityManager->remove($maps);
            $entityManager->flush();
        }

        return $this->redirectToRoute('maps', [], Response::HTTP_SEE_OTHER);
    }
}
