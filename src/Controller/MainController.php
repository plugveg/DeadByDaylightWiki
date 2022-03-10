<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MainController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     *
     * @Route("/", name="main_index")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Users = $em->getRepository(User::class)->findAll();
        //if(in_array('ROLE_ADMIN', $user->getRoles())){
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
