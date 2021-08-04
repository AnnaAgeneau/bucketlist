<?php
namespace App\Controller;

use App\Entity\Wish;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish")
 */


class WishController extends AbstractController
{

/**
 * @Route("/list", name="wish_list")
 */

 public function list():Response
{
    return $this->render("personne/list.html.twig");
}

/**
 * @Route("/details", name="wish_details")
 */

 public function details():Response
 {
    return $this->render("personne/details.html.twig");
 }

/**
 * @Route("/ajouter", name="wish_ajouter")
 */

public function ajouter(EntityManagerInterface $em):Response
{
    // $em = $this->  getDoctrine()->getManager(); autre version que ce qu'on injecte dans ajouter() injection de dépendance
    $wish = new Wish();
    // on hydrate
    $wish-> setTitle('Pape');
    $wish-> setDescription('je souhaiterai rencontrer le Pape');
    $wish-> setAuthor('Maxime');
    $wish-> setIsPublished('true');
    $wish-> setDateCreated(new \DateTime());
    // mettre à disposition de doctrine
    $em-> persist($wish);
    // flush pour envoyer dans la BDD
    $em->flush();

    return $this->redirectToRoute('home');

}

/**
    * @Route("/supprimer/{id}", name="wish_supprimer")
    */
    public function supprimer(Wish $wish, EntityManagerInterface $em):Response{

        // pas besoin de persister
        $em->remove($wish);
        $em->flush();
        return $this->redirectToRoute('home');
    }

}