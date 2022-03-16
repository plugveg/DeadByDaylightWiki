<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UsersFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/page")
 */
class AdminPageController extends AbstractController
{
    /**
     * @Route("/", name="admin_page")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Users = $em->getRepository(User::class)->findAll();


        return $this->render('admin_page/index.html.twig', [
            'controller_name' => 'AdminPageController',
            'Users' => $Users,
        ]);
    }

    /**
     * @Route ("/{id}/read", name="user_read")
     */
    public function read(ManagerRegistry $doctrine, int $id){
        $em = $doctrine->getManager();

        $user = $em->getRepository(User::class)->find($id);

        return $this->renderForm('admin_page/read.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="users_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, User $users, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UsersFormType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('main_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_page/edit.html.twig', [
            'users' => $users,
            'formuser' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="users_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, User $users, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$users->getId(), $request->request->get('_token'))) {
            $entityManager->remove($users);
            $entityManager->flush();
        }

        return $this->redirectToRoute('main_index', [], Response::HTTP_SEE_OTHER);
    }

}
