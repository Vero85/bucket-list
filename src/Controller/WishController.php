<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    //*****************- 1 page liste qui affichera la liste des choses à faire - ******************************************

    /**
     * @Route("/list", name="list")
     */
    public function list(): Response
    {
        return $this->render('wish/list.html.twig');
    }

    //*****************- 1 page détail qui affichera les détails sur une idée de chose à faire - ******************************************

    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function detail(Wish $w): Response
    {
        //dd($w);
        return $this->render('wish/detail.html.twig', ['wish' => $w]);
    }

    //*****************- Ajouter un voeux - ******************************************
    /**
     * @Route("/ajouter", name="wish_ajouter")
     */
    public function ajouter(EntityManagerInterface $em, Request $request): Response

    {

        //j'instancie le formulaire en créant une entité vide et un formulaire
        $wish = new Wish();
        //je relie le formulaire à wish
        $formWish = $this->createForm(WishType::class, $wish);
        // grace à handle request il hydrate automatiquement wish
        $formWish->handleRequest($request);

        if ($formWish->isSubmitted() && $formWish->isValid()) {
            $em->persist($wish);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        //j'appelle la page Twig en affichant le formulaire
        return $this->render('wish/ajouter.html.twig', ["formWish" => $formWish->createView()]);


        /*
        //soit on type la function ajouter ci-dessus soit on fait la ligne ci-dessous
        $em = $this->getDoctrine()->getManager();

        //instancier un nouveau voeux
        $wish1 = new Wish();
        //on hydrate 
        $wish1->setTitle("Faire un saut à l'élastique");
        $wish1->setDescription('depuis mon lit');
        $wish1->setAuthor('Antoine');
        $wish1->setIsPublished(true);
        $wish1->setDateCreated(new \DateTime());
        
        //persister : mettre a dispo du "manager" Doctrine 
        $em->persist($wish1);
        //flush equivaut à save
        $em->flush();

        return $this->redirectToRoute('home');
        */
    }


    //*****************- Suppression d'un voeux - ******************************************
    /**
     * @Route("/enlever/{id}", name="wish_enlever")
     */

    public  function enlever(Wish $wish1, EntityManagerInterface $em): Response
    {

        //persister : mettre a dispo du "manager" Doctrine 
        $em->remove($wish1);
        //flush equivaut à save
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
