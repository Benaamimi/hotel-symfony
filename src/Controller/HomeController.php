<?php

namespace App\Controller;

use App\Entity\Slider;
use App\Repository\ChambreRepository;
use App\Repository\SliderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index')]
    public function index(): Response
    {
        return $this->render('pages/accueil.html.twig');
    }

    #[Route('/chambres', name: 'rooms')]
    public function rooms(SliderRepository $repo, ChambreRepository $rp): Response
    {
        return $this->render('pages/chambres.html.twig', [
            'sliders' => $repo->findBy([],['ordre' => 'ASC']),
            'chambres' => $rp->findAll()
        ]);
    }

    #[Route('/restaurant', name: 'resto')]
    public function resto(): Response
    {
        return $this->render('pages/resto.html.twig');
    }


    #[Route('/spa', name: 'spa')]
    public function spa(): Response
    {
        return $this->render('pages/spa.html.twig');
    }


    #[Route('/contact', name: 'contact')]
    public function form(): Response
    {
        return $this->render('pages/contact.html.twig');
    }


}


