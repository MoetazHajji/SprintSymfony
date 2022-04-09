<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gcu")
 */
class GCUController extends AbstractController
{
    /**
     * @Route("/condtions-generales-utilisation", name="gcu_conditions")
     */
    public function index(): Response
    {
        return $this->render('gcu/index.html.twig', [
            'controller_name' => 'GCUController',
        ]);
    }
}
