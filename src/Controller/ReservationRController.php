<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\ReservationR;
use App\Entity\Restau;
use App\Entity\Userrr;
use App\Form\ReservationRType;
use App\Repository\ReservationRRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationRController extends AbstractController
{
    /**
     * @Route("/reservation/r", name="app_reservation_r")
     */
    public function index(): Response
    {
        return $this->render('reservation_r/index.html.twig', [
            'controller_name' => 'ReservationRController',
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     * @Route ("/addreservation",name="reserver")
     */
    public function ajouterreservation(\Symfony\Component\HttpFoundation\Request $request)
    {
        $classroom = new ReservationR();
        $id=$_GET['id'];

       $liste = $this->getDoctrine()->getRepository(Restau::class)->find($id);
        $liste1 = $this->getDoctrine()->getRepository(Userrr::class)->find(1);
        $form = $this->createForm(ReservationRType::class, $classroom);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $classroom->setIdR($liste);
            $classroom->setIdu($liste1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('affichee');

        }
        return $this->render("reservation_r/addreservation.html.twig", array('formm' => $form->createView(),'image'=>$liste->getImgR(),'nom'=> $liste->getNomR()));


    }

    /**
     * @return Response
     * @Route ("/aff",name="affichee")
     */
    function afficher()
    {


        $liste = $this->getDoctrine()->getRepository(Produit::class)->findall();
        $liste1 = $this->getDoctrine()->getRepository(Restau::class)->findall();
        return $this->render('produit/prodfront.html.twig', ['products' => $liste,'tabrestau' => $liste1]);




    }
    /**
     * @Route ("/affichereservation",name="affichereservation")
     *
     */

    function affichage()
    {


        $liste = $this->getDoctrine()->getRepository(ReservationR::class)->findall();
        $liste2 = $this->getDoctrine()->getRepository(Restau::class)->find(6);

        return $this->render('reservation_r/affichagereservation.html.twig', ['tab' => $liste,'tab2' => $liste2]);




    }
    /**
     * @return Response
     * @Route ("/deletereservation/{id}",name="suppreservation")
     */
    public function delete($id)
    {
        {$objsupp=$this->getDoctrine()->getRepository(ReservationR::class)->find($id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($objsupp);
            $em->flush();

            return $this->redirectToRoute('affichereservation');
        }
    }



}
