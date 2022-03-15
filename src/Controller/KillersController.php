<?php

namespace App\Controller;

use App\Entity\Killers;
use App\Form\KillersFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/killers")
 */
class KillersController extends AbstractController
{
    /**
     * @Route("/", name="killers")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Killers = $em->getRepository(Killers::class)->findAll();

        return $this->render('killers/index.html.twig', [
            'controller_name' => 'KillersController',
            'Killers' => $Killers,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="killer_read")
     */
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $killer = $em->getRepository(Killers::class)->find($id);

        return $this->renderForm('killers/read.html.twig', [
            'killer' => $killer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="killers_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Killers $killers, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(KillersFormType::class, $killers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('killers', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('killers/edit.html.twig', [
            'killers' => $killers,
            'formkiller' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="killers_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Killers $killers, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$killers->getId(), $request->request->get('_token'))) {
            $entityManager->remove($killers);
            $entityManager->flush();
        }

        return $this->redirectToRoute('killers', [], Response::HTTP_SEE_OTHER);
    }
}
