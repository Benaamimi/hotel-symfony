<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function commande(Commande $commande = null, EntityManagerInterface $manager, Request $rq): Response
    {
        if (!$commande) {
            $commande = new Commande;
            $commande->setDateEnregistrement(new \DateTime());
            
        }
        $form = $this->createForm(CommandeType::class, $commande, ['chambre' => true]);

        $form->handleRequest($rq);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $depart = $commande->getDateArrivee();

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
            $prixTotal = ($commande->getChambre()->getPrixJournalier() * $days) + $commande->getChambre()->getPrixJournalier();

            $commande->setPixTotal($prixTotal);

            $manager->persist($commande);
            $manager->flush();
            $this->addFlash('success', 'Votre reservation a bien été valider!');
            return $this->redirectToRoute('home_index');
        }
        return $this->render('commande/index.html.twig', [
            'form' => $form,
        ]);
    }

}
