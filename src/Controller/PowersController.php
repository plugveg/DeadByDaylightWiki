<?php

namespace App\Controller;

use App\Entity\Powers;
use App\Form\PowersFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/powers")
 */
class PowersController extends AbstractController
{
    /**
     * @Route("/", name="powers")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Powers = $em->getRepository(Powers::class)->findAll();

        return $this->render('powers/index.html.twig', [
            'controller_name' => 'PowersController',
            'Powers' => $Powers,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="powers_read")
     */
    public function read(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $power = $em->getRepository(Powers::class)->find($id);

        return $this->renderForm('powers/read.html.twig', [
            'power' => $power,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="powers_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Powers $powers, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PowersFormType::class, $powers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('powers', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('powers/edit.html.twig', [
            'powers' => $powers,
            'formpower' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="powers_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Powers $powers, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$powers->getId(), $request->request->get('_token'))) {
            $entityManager->remove($powers);
            $entityManager->flush();
        }

        return $this->redirectToRoute('powers', [], Response::HTTP_SEE_OTHER);
    }
}
