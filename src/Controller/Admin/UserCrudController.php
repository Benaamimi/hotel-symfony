<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(public UserPasswordHasherInterface $hasher)
    {
        
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('pseudo', 'Pseudo'),
            TextField::new('nom', 'Nom de famille'),
            TextField::new('prenom', 'Prénom'),
            TextField::new('email', 'E-mail'),
            ChoiceField::new('civilite')->setChoices([
                'femme' => 'Mme.',
                'homme' => 'M.',
            ]),
            // ChoiceField::new('roles')->renderExpanded(true),
            TextField::new('password', 'Mot de passe')->setFormType(PasswordType::class)->onlyWhenCreating(),
            CollectionField::new('roles')->setTemplatePath('/admin/field/roles.html.twig'),
            DateTimeField::new('dateEnregistrement', "Date d'enregistrement")->hideOnForm()->setFormat('dd.MM.yyyy à HH:mm:ss'),

        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $user = new $entityFqcn; //= $article = new Article
        $user->setDateEnregistrement(new \DateTime());

        return $user;
    }

    public function persistEntity(EntityManagerInterface $manager, $entityInstance): void
    {
        //si mon user n'a pas d'id (création d'utilisateur)
        if(!$entityInstance->getId())
        {
            $entityInstance->setPassword(
                $this->hasher->hashPassword($entityInstance, $entityInstance->getPassword())
            );
        }

        $manager->persist($entityInstance);
        $manager->flush();
    }
        
}
    

