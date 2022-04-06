<?php

namespace App\Controller;

use App\Entity\Ad;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * Permet d'afficher une seule annonce
     * @Route("/ads/{slug}",name="ads_show")
     * @return  Response 
     */

    public function show($slug, AdRepository $repo)
    {
        //je recupere l'annonce qui correspond au slug
        $ad = $repo->findOneBySlug($slug);
        // dd($ad);
        return  $this->render('ad/show.html.twig', ['ad' => $ad]);
    }
}
