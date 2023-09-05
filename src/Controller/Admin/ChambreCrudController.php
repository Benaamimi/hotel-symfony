<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre', 'Titre'),
            ChoiceField::new('descriptionCourt', 'Gamme de chambre')->setChoices([
                'Classic' => 'Chambre Classic',
                'Confort' => 'Chambre Confort',
                'Suite' => 'Suite',
            ]),
            TextareaField::new('descriptionLongue', 'Description de chambre'),
            IntegerField::new('prixJournalier','Prix par nuit'),
            DateTimeField::new('dateEnregistrement', "Date d'enregistrement")->hideOnForm()->setFormat('dd.MM.yyyy à HH:mm:ss'),
            // AssociationField::new('category', 'Categorie'),

            //traitement d'image
            //creation (new)
            ImageField::new('image')->setUploadDir('public/upload/')->setUploadedFileNamePattern('[timestamp]-[slug]-[extension]')->onlyWhenCreating(),
            ImageField::new('image')->setUploadDir('public/upload/')->setUploadedFileNamePattern('[timestamp]-[slug]-[extension]')->setFormTypeOptions(['required' => false])->onlyWhenUpdating(),

            //affichage
            ImageField::new('image')->setBasePath('upload/')->hideOnForm()
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $chambre = new $entityFqcn; 
        $chambre->setDateEnregistrement(new \DateTime());

        return $chambre;
    }

}
