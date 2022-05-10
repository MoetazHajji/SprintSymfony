<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Rate;
use App\Entity\Restau;
use App\Entity\Userrr;
use App\Form\ProduittType;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Repository\RateRepository;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use function MongoDB\BSON\toJSON;
use App\services\QrcodeService;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="app_produit")
     */
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    public function rat($prod)
    {
        $rate = new Rate();

        $user = $this->getDoctrine()->getRepository(Userrr::class)->find(1);
        $rate->setProduit($prod);
        $rate->setUser($user);
        $rate->setRate(0);
        // $classroom->setRating($rating);
        $em = $this->getDoctrine()->getManager();
        $em->persist($rate);
        $em->flush();

    }

    /**
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/add",name="add")
     */
    public function ajouterproduit(\Symfony\Component\HttpFoundation\Request $request, QrcodeService $qrcodeService)
    {

        $classroom = new Produit();

        $form = $this->createForm(ProduitType::class, $classroom);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);
        $qrCode="";

        if ($form->isSubmitted()&& $form->isValid()) {

            $file = $form['image']->getData();
            dump($file);
            $file->move("images/", $file->getClientOriginalName());
            $classroom->setImage("images/".$file->getClientOriginalName());
            $classroom->setRating(0);
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $qrCode= $qrcodeService->qrcode($data->getstock());

            $em->persist($classroom);
            $em->flush();
            $this->rat($classroom);




            return $this->render("produit/produitadmin.html.twig", array('form' => $form->createView(),'qrCode'=>$qrCode));
        }
        return $this->render("produit/produitadmin.html.twig", array('form' => $form->createView(),'qrCode'=>$qrCode));

    }

    /**
     * @Route ("/affiche",name="affiche")
     *
     */

    function affichage()
    {


            $liste = $this->getDoctrine()->getRepository(Produit::class)->findall();

            return $this->render('produit/affichageproduit.html.twig', ['tab' => $liste]);




    }
    /**
     * @return Response
     * @Route ("/delete/{id}",name="supp")
     */
    public function delete($id)
    {
        {$objsupp=$this->getDoctrine()->getRepository(Produit::class)->find($id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($objsupp);
            $em->flush();

            return $this->redirectToRoute('affiche');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/update/{id}",name="update")
     */
    public function updatee(Request $request,$id,ProduitRepository $repository)
    {
        $classroomm = new Produit();
        $classroom = $repository->find($id);
        $form = $this->createForm(ProduittType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('affiche');
        }

        return $this->render("produit/updateprod.html.twig",array('form'=>$form->createView()));
    }
    /**
     * @Route ("/aff",name="aff")
     *
     */

    function afficher()
    {


        $liste = $this->getDoctrine()->getRepository(Produit::class)->findall();
        $liste1 = $this->getDoctrine()->getRepository(Restau::class)->findall();
        return $this->render('produit/prodfront.html.twig', ['products' => $liste,'tabrestau' => $liste1]);




    }

    /**
     * @Route ("/getCartInfo",name="getCartInfo")
     *
     */
    public function renderCart(){

        return $this->render('produit/cart.html.twig');
    }

    /**
     * @param ProduitRepository $repository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *  @Route ("/rating",name="rating")
     */
    public function rating(ProduitRepository $repository, Request $request)
    {

       $id=$request->request->get('idd');
       // $rating=$_GET['note'];
        $rate = new Rate();
        $classroom = $repository->find($id);

        $liste1 = $this->getDoctrine()->getRepository(Userrr::class)->find(1);

           $rating =$request->request->get('notee');
              $rate->setProduit($classroom);
              $rate->setUser($liste1);
              $rate->setRate($rating);
           // $classroom->setRating($rating);
            $em = $this->getDoctrine()->getManager();
            $em->persist($rate);
            $em->flush();


        return new JsonResponse(array('operation'=>'success'));


    }

    /**
     * @return Response
     *  @Route ("/detail",name="details")
     */
    function afficherproduitdetail(RateRepository $repository)
    {
        $id=$_GET['id'];

        $liste = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        $prod5=$repository->stat5($id);
        $prod4=$repository->stat4($id);
        $prod3=$repository->stat3($id);
        $prod2=$repository->stat2($id);
        $prod1=$repository->stat1($id);
        $nbr=$repository->nbrproduit($id);




        return $this->render('produit/detail.html.twig', ['tab'=>$liste,'image' => $liste->getImage(),'nom'=>$liste->getNom(),'prix'=>$liste->getPrix(),'idproduit'=>$liste->getId(),
            'rate5'=>$prod5,
            'rate4'=>$prod4,
            'rate3'=>$prod3,
            'rate2'=>$prod2,
            'rate1'=>$prod1,
            'nbr'=>$nbr]);




    }

    /**
     *
     */
    function statt(RateRepository $repository,$id)
    {
      $repository->stat5($id);
    }
    /**
     * @Route ("/afficheprod",name="afficheprod")
     *
     */

    function afficherprod(NormalizerInterface $normalize)
    {


        $listeprodd = $this->getDoctrine()->getRepository(Produit::class)->findall();
        $jsoncontent = $normalize->normalize($listeprodd,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsoncontent));





    }



}
