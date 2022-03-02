<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{

    /**
     * @Route("/hello/{prenom}/age/{age}",name="hello")
     * @Route("/hello",name="hello_base")
     * @Route("/hello/{prenom}/hamarrass",name="hello_prenom")
     * Montre la page qui dit Bonjour 
     */

    public function hello($prenom = " ", $age  = " ")
    {
        return
            $this->render('hello.html.twig', ['prenom' => $prenom, 'age' => $age]);
    }

    /**
     * @Route("/",name="homepage")
     */
    public function home()
    {
        $tableau = ['hassan' => 23, 'hamarrass' => 34, 'jamal' => 32];

        return
            // new Response("Bonjour a tous ");
            $this->render('home.html.twig', [
                'title'   => 'hi guys i love you all ',
                'age'     => '19',
                'tableau' => $tableau
            ]);
    }
}
