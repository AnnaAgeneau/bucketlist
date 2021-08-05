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

public function ajouter(EntityManagerInterface $em, Request $request):Response
{

    $wish = new Wish(); // je crée une entité vide
    // je crée le formulaire
    $formWish = $this->createForm(WishType::class, $wish);

    // association du formulaire avec les données envoyées
        // hydrater $wish
    $formWish->handleRequest($request);

    if($formWish->isSubmitted() && $formWish->isValid())
        {
            
            $em->persist($wish);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('personne/ajouter.html.twig', ['formWish' => $formWish->createView()]);

   return $this->redirectToRoute('home');

/*
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
*/

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

    /**
    * @Route("/liste", name="wish_liste")
    */
    public function liste(WishRepository $repo):Response{

        $wish = $repo->findAll();
        return $this->redirectToRoute('home');
    }

}