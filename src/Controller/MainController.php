<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Wish;
use App\Form\ContactType;
use App\Repository\CategoryRepository;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function home(CategoryRepository $repo): Response
    {
        $categs = $repo->findAll();
        return $this->render('projet/home.html.twig', ['categs' => $categs]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(EntityManagerInterface $em, Request $request): Response
    {

        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);

        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            //$nom = $formContact->get('nom')->getData();
            //dd($nom);
            $em->persist($contact);
            $em->flush();

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
