<?php

namespace App\Controller;

use App\Entity\Maps;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 *
 * @Route("/map")
 */
class MapController extends AbstractController
{
    /**
     *
     * @Route("/", name="map")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $maps = $entityManager->getRepository(Maps::class)->findAll();

        return $this->render('map/index.html.twig',[
            'controller_name' => 'MapController',
           'Maps'=>$maps,
        ]);
    }
}
