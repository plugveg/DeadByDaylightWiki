<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity et Form*/
use App\Entity\User;
use App\Form\RegistrationFormType;
/*Les use nécessaires pour lancer le code*/
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /*La route menant à la main page d'inscription*/
    /**
     * @Route("/register", name="app_register")
     */
    /*Cette fonction permet d'enregistrer un nouvel user dans la base de données */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        /*création du formulaire*/
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('login');//la redirection après la connection
        }

        /*Le rendu en HTML*/
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
