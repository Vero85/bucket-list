<?php

namespace App\Controller;

use App\Entity\Wish;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    // 1 page liste qui affichera la liste des choses à faire
    /**
     * @Route("/list", name="list")
     */
    public function list(): Response
    {
        return $this->render('wish/list.html.twig');
    }


    // 1 page détail qui affichera les détails sur une idée de chose à faire
        /**
     * @Route("/detail", name="detail")
     */
    public function detail(): Response
    {
        return $this->render('wish/detail.html.twig');
    }

        /**
     * @Route("/ajouter", name="wish_ajouter")
     */

public  function ajouter(EntityManagerInterface $em):Response
{
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


}


        /**
     * @Route("/enlever/{id}", name="wish_enlever")
     */

    public  function enlever(Wish $wish1, EntityManagerInterface $em):Response
    {
       
            
        //persister : mettre a dispo du "manager" Doctrine 
        $em->remove($wish1);
        //flush equivaut à save
        $em->flush();
    
        return $this->redirectToRoute('home');
    
        
    }

}
