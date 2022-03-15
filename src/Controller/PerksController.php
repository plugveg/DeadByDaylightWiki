<?php

namespace App\Controller;

use App\Entity\Perks;
use App\Form\PerksFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/perks")
 */
class PerksController extends AbstractController
{
    /**
     * @Route("/", name="perks")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Perks = $em->getRepository(Perks::class)->findAll();
        dump($Perks[0]->getPerkSurvivor()->getSurvivorName());

        return $this->render('perks/index.html.twig', [
            'controller_name' => 'PerksController',
            'Perks' => $Perks,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="perks_read")
     */
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $perk = $em->getRepository(Perks::class)->find($id);

        return $this->renderForm('perks/read.html.twig', [
            'perk' => $perk,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="perks_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Perks $perks, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PerksFormType::class, $perks);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('perks', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perks/edit.html.twig', [
            'perks' => $perks,
            'formperk' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="perks_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Perks $perks, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perks->getId(), $request->request->get('_token'))) {
            $entityManager->remove($perks);
            $entityManager->flush();
        }

        return $this->redirectToRoute('perks', [], Response::HTTP_SEE_OTHER);
    }
}
