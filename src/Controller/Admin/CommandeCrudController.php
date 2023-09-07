<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom', 'Nom'),
            TextField::new('prenom', 'Prenom'),
            TextField::new('email', 'E-mail'),
            TextField::new('telephone', 'Numero de téléphone'),
            
            TextField::new('titre', 'Chambre'),
           
            DateTimeField::new('dateArrivee', "Date d'arrivee")->setFormat('dd.MM.yyyy à HH:mm:ss'),
            DateTimeField::new('dateDepart', "Date de depart")->setFormat('dd.MM.yyyy à HH:mm:ss'),
            IntegerField::new('pixTotal','Prix par nuit'),   
            DateTimeField::new('dateEnregistrement', "Date d'enregistrement")->hideOnForm()->setFormat('dd.MM.yyyy à HH:mm:ss'),

        ];
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Commande::class,
    //     ]);
    // }

    public function createEntity(string $entityFqcn)
    {
        $commande = new $entityFqcn; 
        $commande->setDateEnregistrement(new \DateTime());

        return $commande;
    }
    
}
