<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\ContactType;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Flex\Path;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(WishRepository $repo): Response
    {
        $wish1 = $repo->findBy([], ['dateCreated' => 'ASC']);
        return $this->render('projet/home.html.twig', ['voeux' => $wish1]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request): Response
    {
        $formContact = $this->createForm(ContactType::class);

        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $nom = $formContact->get('nom')->getData();
            dd($nom);
            // $em->persist($wish);
            //$em->flush();

            return $this->redirectToRoute('home');
        }

        //j'appelle la page Twig
        return $this->render('wish/contact.html.twig', ["formContact" => $formContact->createView()]);
    }


    /**
     * @Route("/about-us", name="about_us")
     */
    public function about(): Response
    {
        //$Route = new Route()
        return $this->render("projet/about-us.html.twig");
    }
}
