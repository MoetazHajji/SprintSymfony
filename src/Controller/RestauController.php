<?php

namespace App\Controller;

use App\Entity\Restau;
use App\Form\RestauType;
use App\Form\RestauuType;
use App\Repository\RestauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestauController extends AbstractController
{
    /**
     * @Route("/restau", name="app_restau")
     */
    public function index(): Response
    {
        return $this->render('restau/index.html.twig', [
            'controller_name' => 'RestauController',
        ]);
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/restauaddd",name="restauadd")
     */
    public function ajouterproduit(Request $request)
    {
        $classroom = new Restau();
        $form = $this->createForm(RestauType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) {
            $file = $form['imgR']->getData();
            dump($file);
            $file->move("images/", $file->getClientOriginalName());
            $classroom->setImgR("images/".$file->getClientOriginalName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('afficherestau');
        }
        return $this->render("restau/restauadd.html.twig", array('form' => $form->createView()));

    }

    /**
     * @Route ("/afficherestau",name="afficherestau")
     *
     */

    function affichage()
    {


        $liste = $this->getDoctrine()->getRepository(Restau::class)->findall();

        return $this->render('restau/affichagerestau.html.twig', ['tab' => $liste]);




    }
    /**
     * @return Response
     * @Route ("/deletereatu/{id}",name="supprestau")
     */
    public function delete($id)
    {
        {$objsupp=$this->getDoctrine()->getRepository(Restau::class)->find($id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($objsupp);
            $em->flush();

            return $this->redirectToRoute('afficherestau');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/updaterestau/{id}",name="updaterestau")
     */
    public function updatee(Request $request,$id,RestauRepository  $repository)
    {
        $classroomm = new Restau();
        $classroom = $repository->find($id);
        $form = $this->createForm(RestauuType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('afficherestau');
        }

        return $this->render("restau/updaterestau.html.twig",array('form'=>$form->createView()));
    }



}
