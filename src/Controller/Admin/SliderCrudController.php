<?php

namespace App\Controller\Admin;

use App\Entity\Slider;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slider::class;
    }

    public function configureFields(string $pageName): iterable
    {

    return [
        IdField::new('id')->hideOnForm(),
        ImageField::new('image')->setBasePath('upload/')->hideOnForm(),
        DateTimeField::new('dateEnregistrement', "Date d'enregistrement")->hideOnForm()->setFormat('dd.MM.yyyy à HH:mm:ss'),
        ImageField::new('image')->setUploadDir('public/upload/')->setUploadedFileNamePattern('[timestamp]-[slug]-[extension]')->onlyWhenCreating(),
        ImageField::new('image')->setUploadDir('public/upload/')->setUploadedFileNamePattern('[timestamp]-[slug]-[extension]')->setFormTypeOptions(['required' => false])->onlyWhenUpdating(),
        // IntegerField::new('ordre','Ordre'),
        ChoiceField::new('ordre','Ordre')->setChoices([
            1 => 1,
            2 => 2,
            3 => 3,
        ]),
    ];
}

public function createEntity(string $entityFqcn)
{
    $chambre = new $entityFqcn; 
    $chambre->setDateEnregistrement(new \DateTime());

    return $chambre;
}

}




