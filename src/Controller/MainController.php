<?php

/*Info sur le current directory*/
namespace App\Controller;

/*Permet l'importation des différentes Entity*/
use App\Entity\User;
/*Les use nécessaires pour lancer le code*/
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MainController extends AbstractController
{
    /*La route menant à la main page du site*/
    /**
     * @IsGranted("ROLE_USER")
     *
     * @Route("/", name="main_index")
     */
    public function index(EntityManagerInterface $em): Response
    {
        /*Permet de récupérer toutes les entrées des users dans la base de données*/
        $Users = $em->getRepository(User::class)->findAll();
        //if(in_array('ROLE_ADMIN', $user->getRoles())){

        /*Le rendu en HTML*/
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'Users' => $Users,
        ]);
        /*}
        else{
            //utilisateur non admin
            return $this->render('main/index.html.twig', [
                'controller_name' => 'MainController',
            ]);
        }*/

    }

}
