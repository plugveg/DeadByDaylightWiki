<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity*/
use App\Entity\User;
use App\Form\UsersFormType;
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
 * @Route("/admin/page")
 */
class AdminPageController extends AbstractController
{
    /*La route menant à la main page*/
    /**
     * @Route("/", name="admin_page")
     */
    /*Cette fonction renvoie à la main page du controller AdminController*/
    public function index(EntityManagerInterface $em): Response
    {
        /*Permet de récupérer toutes les entrées des users dans la base de données*/
        $Users = $em->getRepository(User::class)->findAll();

        /*Le rendu en HTML*/
        return $this->render('admin_page/index.html.twig', [
            'controller_name' => 'AdminPageController',
            'Users' => $Users,
        ]);
    }

    /*La route menant à la page read*/
    /**
     * @Route ("/{id}/read", name="user_read")
     */
    /*Cette fonction renvoie à la page permettant de lire les differents Users*/
    public function read(ManagerRegistry $doctrine, int $id){
        /*Permet de récupérer toutes les entrées des users selon leurs id dans la base de données*/
        $em = $doctrine->getManager();
        $user = $em->getRepository(User::class)->find($id);

        /*Le rendu en HTML*/
        return $this->renderForm('admin_page/read.html.twig', [
            'user' => $user,
        ]);
    }

    /*La route menant à la pade d'edit*/
    /**
     * @Route("/{id}/edit", name="users_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    /*Cette fonction renvoie au formulaire d'édition permettant de modifier ou de supprimer un User*/
    /*@IsGranted("ROLE_ADMIN") permet de donner l'accès à cette page seulement au User ayant le rôle Admin
    Même si la main page (Donc l'adminController) n'est déjà accessible seulement pour les rôles Admin*/
    public function edit(Request $request, User $users, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire d'edit*/
        $form = $this->createForm(UsersFormType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('main_index', [], Response::HTTP_SEE_OTHER);
        }

        /*Le rendu en HTML*/
        return $this->renderForm('admin_page/edit.html.twig', [
            'users' => $users,
            'formuser' => $form,
        ]);
    }

    /*La route menant à la fonction delete*/
    /**
     * @Route("/{id}", name="users_delete", methods={"GET", "POST"})
     */
    /*Cette fonction n'a pas de twig car elle permet seulement la suppression d'un User lorsque l'on clique sur le bouton 'Delete'
    dans le admin_page/edit.html.twig*/
    public function delete(Request $request, User $users, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$users->getId(), $request->request->get('_token'))) {
            $entityManager->remove($users);
            $entityManager->flush();
        }

        return $this->redirectToRoute('main_index', [], Response::HTTP_SEE_OTHER);
    }

}
