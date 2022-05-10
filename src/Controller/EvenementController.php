<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\RequestStack;
use Dompdf\Dompdf;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Options;


/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    
    /**
     * @Route("/", name="app_evenement_index", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate( $evenementRepository->findAll(), $request->query->getInt('page',1), 4);
        return $this->render('evenement/index.html.twig', [
            'evenements' => $pagination,
        ]);
    }
    /**
     * @Route("/listp/{id}", name="listp")
     */
    public function listp(Evenement $evenement)
    {$pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);


        $Evenement = $this->getDoctrine()->getRepository(Evenement::class)->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('evenement/listp.html.twig', ["evenement" => $Evenement]);

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


    /**
     * @Route("/new", name="app_evenement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EvenementRepository $evenementRepository): Response
    {

        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $evenement->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $this->addFlash('info', 'Ajout avec succés !');
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $entityManager = $this->getDoctrine()->getManager();
            $evenement->setImage($fileName);
            $entityManager->persist($evenement);
            $entityManager->flush();
            $evenementRepository->add($evenement);
            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }
    /**
     * @Route("/new", name="app_event_ticket", methods={"GET", "POST"})
     */
    public function ticket(Request $request, EvenementRepository $evenementRepository): Response
    {

        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $evenement->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $entityManager = $this->getDoctrine()->getManager();
            $evenement->setImage($fileName);
            $entityManager->persist($evenement);
            $entityManager->flush();
            $evenementRepository->add($evenement);
            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="app_evenement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $evenementRepository->add($evenement);

            $this->addFlash('info', 'modification avec succés !');
            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $evenementRepository->remove($evenement);
            $this->addFlash('info', 'supression avec succés !');
            

        }


        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route ("/" , name="app_event_show_front" , methods={"GET"})
     */
    public function affi(){
        $list=$this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render('evenement/home.html.twig' , ['events'=>$list]);
    }


}
