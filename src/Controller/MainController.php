<?php
namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(WishRepository $repo):Response
    {
        $wishes = $repo->findAll();
        return $this->render("personne/home.html.twig", ['wish'=> $wishes]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact():Response
    {
        //$route = new Route
        return $this->render("personne/contact.html.twig");
    }

    /**
     * @Route("/about", name="about_us")
     */
    public function about():Response
    {
        //$route = new Route
        return $this->render("personne/about_us.html.twig");
    }

    /**
     * @Route("/backOffice", name="back_home")
     */
    public function backOffice(WishRepository $repo):Response
    {
        //$route = new Route
        $wishes = $repo->findAll();
        return $this->render("back/home_back.html.twig",['wishes' =>$wishes]);
    }




}