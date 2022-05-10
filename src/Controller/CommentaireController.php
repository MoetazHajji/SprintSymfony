<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Commentaire;
use App\Entity\Produit;
use App\Entity\Restau;
use App\Entity\Userrr;
use App\Form\CommandeType;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="app_commentaire")
     */
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/addcommentaire",name="commenter")
     */
    public function ajouterreservation(\Symfony\Component\HttpFoundation\Request $request)
    {

            $classroom = new Commentaire();
            $id=$_GET['id'];

            $liste = $this->getDoctrine()->getRepository(Restau::class)->find($id);
            $idd=$liste->getId();
        $liste2 = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idR'=> $liste));

        $liste3 = $this->getDoctrine()->getRepository(Userrr::class)->find(1);
        $liste4= $this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idu'=>'1'));
            $form = $this->createForm(CommentaireType::class, $classroom);

            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                $classroom->setIdR($liste);
                $classroom->setIdu($liste3);
                $em = $this->getDoctrine()->getManager();
                $em->persist($classroom);
                $em->flush();

            }

            return $this->render("commentaire/addcommentaire.html.twig", array('form' => $form->createView(),'image'=>$liste->getImgR(),'tab'=>$liste2,'nom'=>$liste3->getName(),'prenom'=>$liste3->getLastname(),'tab1'=>$liste4));



        }


    /**
     * @return Response
     * @Route ("/affichecomm",name="affichecomm")
     */

   public function affichage()
    {



        $liste = $this->getDoctrine()->getRepository(Commentaire::class)->findall();
        $listeuser=$this->getDoctrine()->getRepository(Userrr::class)->find(1);

        return $this->render('commentaire/affichagecommentaire.html.twig',['tab' => $liste,'nom' => $listeuser->getName()]);




    }
    /**
     * @Route ("/afff",name="afff")
     *
     */

    function afficher()
    {


        $liste = $this->getDoctrine()->getRepository(Produit::class)->findall();
        $liste1 = $this->getDoctrine()->getRepository(Restau::class)->findall();
        return $this->render('produit/prodfront.html.twig', ['products' => $liste,'tabrestau' => $liste1]);




    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/deletecomm/{id}",name="suppcomm")
     */

    public function deletefront($id)
    {
        {$objsupp=$this->getDoctrine()->getRepository(Commentaire::class)->find($id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($objsupp);
            $em->flush();

            return $this->redirectToRoute('afff');
        }
    }
    /**
     * @return Response
     * @Route ("/deletecommentaire/{id}",name="suppcommentaire")
     */
    public function delete($id)
    {
        {$objsupp=$this->getDoctrine()->getRepository(Commentaire::class)->find($id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($objsupp);
            $em->flush();

            return $this->redirectToRoute('affichecomm');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @param CommentaireRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/updatee/{id}",name="updatee")
     */
    public function updatee(Request $request,$id,CommentaireRepository $repository)
    {
        $classroomm = new Commentaire();
        $classroom = $repository->find($id);
        $form = $this->createForm(CommentaireType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('afff');
        }

        return $this->render("commentaire/updatec.html.twig",array('form'=>$form->createView()));
    }






}
