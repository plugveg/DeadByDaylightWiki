<?php

namespace App\Controller;

use App\Entity\PerksKillers;
use App\Form\PerksKillersFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/perks_killers")
 */
class PerksKillersController extends AbstractController
{
    /**
     * @Route("/", name="perks_killers")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $PerksKillers = $em->getRepository(PerksKillers::class)->findAll();

        return $this->render('perks_killers/index.html.twig', [
            'controller_name' => 'PerksKillersController',
            'PerksKillers' => $PerksKillers,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="perkskillers_read")
     */
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $perkkiller = $em->getRepository(PerksKillers::class)->find($id);

        return $this->renderForm('perks_killers/read.html.twig', [
            'perkkiller' => $perkkiller,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="perkskillers_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, PerksKillers $perksKillers, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PerksKillersFormType::class, $perksKillers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('perks_killers', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perks_killers/edit.html.twig', [
            'perkskillers' => $perksKillers,
            'formperkkiller' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="perkskillers_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, PerksKillers $perksKillers, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perksKillers->getId(), $request->request->get('_token'))) {
            $entityManager->remove($perksKillers);
            $entityManager->flush();
        }

        return $this->redirectToRoute('perks_killers', [], Response::HTTP_SEE_OTHER);
    }
}
