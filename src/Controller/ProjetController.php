<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('projet/home.html.twig', );
    }

        /**
     * @Route("/contact", name="contact")
     */
    public function contact():Response
    {
        //$Route = new Route()
        return $this->render("projet/contact.html.twig");
    }


        /**
     * @Route("/about-us", name="about_us")
     */
    public function about():Response
    {
        //$Route = new Route()
        return $this->render("projet/about-us.html.twig");
    }




}
