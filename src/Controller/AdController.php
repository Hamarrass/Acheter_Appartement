<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo): Response
    {
        // dump($session);
        // $repo = $this->getDoctrine()->getRepository(Ad::class);
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }
    /**
     *  Permet de creer une annonce
     *
     * @Route("ads/new",name="ads_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {

        $ad      = new Ad();


        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$manger = $this->getDoctrine()->getManager();
            $manager->persist($ad);
            $manager->flush();
            $this->addFlash(
                'success',
                "L annonce <strong>{$ad->getTitle()}</strong> a bien ete enregistree !"
            );
            return  $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
        }

        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet d'afficher une seule annonce
     * @Route("/ads/{slug}",name="ads_show")
     * @return  Response 
     */

    public function show(Ad $ad)
    {
        //je recupere l'annonce qui correspond au slug
        return  $this->render('ad/show.html.twig', ['ad' => $ad]);
    }
}
