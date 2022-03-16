<?php

namespace App\Controller;

use App\Entity\Survivors;
use App\Form\SurvivorsFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/survivors")
 */
class SurvivorsController extends AbstractController
{
    /**
     * @Route("/", name="survivors")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Survivors = $em ->getRepository(Survivors::class)->findAll();

        //foreach ($Survivors as $survivor) {
            //foreach($survivor->getSurvivorPerk1() as $toto){
                //dump($toto);
            //}
        //}


        return $this->render('survivors/index.html.twig', [
            'controller_name' => 'SurvivorsController',
            'Survivors' => $Survivors,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="survivors_read")
     */
    public function readPerks(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $survivor = $em->getRepository(Survivors::class)->find($id);

        return $this->renderForm('survivors/read.html.twig', [
            'survivor' => $survivor,
        ]);
    }

    /**
     * @Route ("/{id}/edit", name="survivors_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Survivors $survivors, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SurvivorsFormType::class, $survivors);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('survivors', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('survivors/edit.html.twig', [
            'survivors' => $survivors,
            'formsurv' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="survivors_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Survivors $survivors, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$survivors->getId(), $request->request->get('_token'))) {
            $entityManager->remove($survivors);
            $entityManager->flush();
        }

        return $this->redirectToRoute('survivors', [], Response::HTTP_SEE_OTHER);
    }
}
