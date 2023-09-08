<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Contact;
use App\Entity\Commande;
use App\Form\ContactType;
use App\Form\CommandeType;
use App\Repository\SliderRepository;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            'sliders' => $repo->findBy([], ['ordre' => 'ASC']),
            'chambres' => $rp->findAll()
        ]);
    }

    
    #[Route('/chambres/details/{id}', name: 'chambre_details')]
    public function details(ChambreRepository $repo, Chambre $id, Request $rq, EntityManagerInterface $manager)
    {
        $commande = new Commande;
        $chambre = $repo->find($id);
        $commande->setDateEnregistrement(new \DateTime());

        $form = $this->createForm(CommandeType::class, $commande, ['chambre' => false]);

        $form->handleRequest($rq);

        if ($form->isSubmitted() && $form->isValid()) {
            $depart = $commande->getDateArrivee();
            $commande->setChambre($chambre);
            if ($depart->diff($commande->getDateDepart())->invert == 1) {
                $this->addFlash('danger', 'Une période de temps ne peut pas être négative.');
                if ($commande->getId())
                    return $this->redirectToRoute('app_commande', [
                        'id' => $commande->getId()
                    ]);
                else
                    return $this->redirectToRoute('app_commande');
            }

            $days = $depart->diff($commande->getDateDepart())->days;
            $prixTotal = ($chambre->getPrixJournalier() * $days) + $chambre->getPrixJournalier();

            $commande->setPixTotal($prixTotal);

            $manager->persist($commande);
            $manager->flush();
            $this->addFlash('success', 'Votre reservation a bien été valider!');
            return $this->redirectToRoute('home_index');
        }

        return $this->render('pages/details.html.twig', [
            'formChambre' => $form,
            'chambre' => $chambre
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

    #[Route('/legal', name: 'legal')]
    public function legal(): Response
    {
        return $this->render('pages/legal.html.twig');
    }


    #[Route('/contact', name: 'contact')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Contact();
        $contact->setDateEnregistrement(new \DateTime());


        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message a bien été envoyer!'
            );

            return $this->redirectToRoute('contact');
        }

        return $this->render('pages/contact.html.twig', [
            'formContact' => $form->createView()
        ]);  
    }



}
