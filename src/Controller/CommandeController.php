<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Produit;
use App\Entity\User;
use App\Entity\Userrr;
use App\Repository\CommandeRepository;
use App\Repository\NotificationRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use ShopBundle\Entity\Commande;
use ShopBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="app_commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    public function pdf($products)
    {
        $pdfOptions = new Options();

        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $liste2 = $this->getDoctrine()->getRepository(Userrr::class)->find(1);



        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('commande/pdf.html.twig',['tab'=>$products,'nom'=>$liste2->getName(),'prenom'=>$liste2->getlastName()]
        );

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);




    }
    function ajounotif(\App\Entity\Commande $commande,$User)
    {
        $notif = new Notification();
        $notif->setCommande($commande);
        $notif->setUser($User);
        $em = $this->getDoctrine()->getManager();
        $em->persist($notif);
        $em->flush();

    }

    /**
     * @Route("/createOrderAjax", name="createOrderAjax")
     */
    public function createOrderAction(Request $request){
        // si la requete est de type ajax

      // $iddd=$_POST['iddd'];

        $commande=new \App\Entity\Commande();

        $commande->setPrixtotale((float)$request->request->get('total'));
        $idd=$request->request->get('pro');
        $commande->setValide("en cours");
        $commande->setDatecom(new \DateTime('now'));
        $liste2 = $this->getDoctrine()->getRepository(Userrr::class)->find($idd);
        $commande->setIdu($liste2);
        $this->getDoctrine()->getManager()->persist($commande);
        $products=$request->request->get('products');

        foreach ($products as $single)
        {

            $product=$this->getDoctrine()->getRepository(Produit::class)->find((int)$single["id"]);
            $product->setStock($product->getStock()-(int)$single['desiredQuantity']);

            $commande->addProduit($product);


            $this->getDoctrine()->getManager()->flush();

        }


        $this->getDoctrine()->getManager()->persist($commande);
        $this->ajounotif($commande,$liste2);

        return new JsonResponse(array('operation'=>'success'));





    }


    /**
     * @param $produit
     * @return JsonResponse
     * @Route ("/pdf/{id}",name="pdf")
     */


    public function makepdf($id)
    {
        $pdfOptions = new Options();
        $commande=new \App\Entity\Commande();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
       $liste2 = $this->getDoctrine()->getRepository(\App\Entity\Commande::class)->find($id);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('commande/pdf.html.twig',['tab'=>$liste2->getProduits(),'nom'=>$liste2->getPrixtotale(),'name'=>$_POST['nom'],'prenom'=>$_POST['prenom']]
        );

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
        return new JsonResponse($html);




    }
    /**
     * @Route ("/affichecommande",name="affichecommande")
     *
     */

    function affichage(NotificationRepository $repository)
    {


        $liste = $this->getDoctrine()->getRepository(\App\Entity\Commande::class)->findall();
        $listeuser=$this->getDoctrine()->getRepository(Userrr::class)->find(1);
         $nbr=$repository->nbrnotif();
        return $this->render('commande/affichagecommande.html.twig', ['tab' => $liste,'nom'=> $listeuser->getName(),'prenom'=> $listeuser->getLastname(),'nbrnotif'=>$nbr]);




    }
    /**
     * @return Response
     * @Route ("/deletecommande/{id}",name="suppcommande")
     */
    public function delete($id)
    {
        {$objsupp=$this->getDoctrine()->getRepository(\App\Entity\Commande::class)->find($id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($objsupp);
            $em->flush();

            return $this->redirectToRoute('affichecommande');
        }
    }


    public function mail(\Swift_Mailer $mailer)
    {
        $listeuser=$this->getDoctrine()->getRepository(Userrr::class)->find(1);
        $nom=$listeuser->getName();
        $prenom=$listeuser->getLastname();
        $message = (new \Swift_Message(

            'mr/madame'." ".$nom." ".$prenom." ".'votre commande a été bien validé un livreur va vous contacter'))
            ->setFrom('maryoumafarhat98@gmail.com')
            ->setTo('mariem.benkhlifa@esprit.tn');

        $mailer->send($message);


    }

    /**
     * @param Request $request
     * @param $id
     * @param CommandeRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/valide/{id}",name="valide")
     */
    public function updatee(Request $request,$id,CommandeRepository $repository,\Swift_Mailer $mailer)
    {
        $classroomm = new Produit();
        $classroom = $repository->find($id);


            $classroom->setValide("valide");
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
        $this->mail($mailer);
            return $this->redirectToRoute('affichecommande');




    }

    /**
     * @return Response
     * @Route ("/notif",name="notif")
     */
    function afiichenotif()
    {
        $liste = $this->getDoctrine()->getRepository(Notification::class)->findall();
        return $this->render('produit/dashboard.html.twig', ['tabnotif' => $liste]);


    }
    /**
     * @return Response
     * @Route ("/suppnotif/{id}",name="suppnotif")
     */
    public function deletenotif($id)
    {
        {$objsupp=$this->getDoctrine()->getRepository(Notification::class)->find($id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($objsupp);
            $em->flush();

            return $this->redirectToRoute('notif');
        }
    }



}
