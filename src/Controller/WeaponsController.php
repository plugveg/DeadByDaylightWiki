<?php

namespace App\Controller;

use App\Entity\Weapons;
use App\Form\WeaponsFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/weapons")
 */
class WeaponsController extends AbstractController
{
    /**
     * @Route("/", name="weapons")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Weapons = $em->getRepository(Weapons::class)->findAll();

        return $this->render('weapons/index.html.twig', [
            'controller_name' => 'WeaponsController',
            'Weapons' => $Weapons,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="weapons_read")
     */
    public function read(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $weapon = $em->getRepository(Weapons::class)->find($id);

        return $this->renderForm('weapons/read.html.twig', [
            'weapon' => $weapon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="weapons_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Weapons $weapons, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WeaponsFormType::class, $weapons);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('weapons', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('weapons/edit.html.twig', [
            'weapons' => $weapons,
            'formweapon' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="weapons_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Weapons $weapons, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weapons->getId(), $request->request->get('_token'))) {
            $entityManager->remove($weapons);
            $entityManager->flush();
        }

        return $this->redirectToRoute('weapons', [], Response::HTTP_SEE_OTHER);
    }
}
