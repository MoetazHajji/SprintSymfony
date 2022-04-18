<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
* @Route("/Admin")
*/
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="app_admin")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
        /**
         * @Route("/{id}", name="app_user_show", methods={"GET"})
         */
        public function show(User $user): Response
        {
            return $this->render('admin/show.html.twig', [
                'users' => $user,
            ]);
        }

}
