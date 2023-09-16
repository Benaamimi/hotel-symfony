<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        if ($options['chambre']) {
            $builder->add('chambre',  EntityType::class, [
                'class' => Chambre::class,
                'choice_label' => 'titre'
            ]);
        }
        $builder
            // ->add('dateArrivee', DateType::class, array(
            //     "widget" => 'single_text',
            //     "format" => 'yyyy-MM-dd',
            //     "data" => new \DateTime()
            // ))
            // ->add('dateDepart',  DateType::class, array(
            //     "widget" => 'single_text',
            //     "format" => 'yyyy-MM-dd',
            //     "data" => new \DateTime()
            // ))

            ->add('dateArrivee', DateTimeType::class, [
                'widget' => 'single_text',  // permet de choisir l'affichage d'un calendrier (voir doc datetimetype)
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d H:i'), // permet d'empecher de choisir une date ultérieure à celle d'aujourd'hui (voir doc datetime)
                ]
            ])
            ->add('dateDepart', DateTimeType::class, [
                'widget' => 'single_text',  // permet de choisir l'affichage d'un calendrier (voir doc datetimetype)
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d H:i'), // permet d'empecher de choisir une date ultérieure à celle d'aujourd'hui (voir doc datetime)
                ]
            ])

            
            
            ->add('nom')
            ->add('prenom', TextType::class, ['label' => 'Prénom'])
            ->add('email')
            ->add('telephone', TextType::class, ['label' => 'Numero de téléphone'])

            // ->add('pixTotal')
            // ->add('dateEnregistrement')

            // ->add('submit', SubmitType::class, [
            //     'attr' => [
            //         'class' => 'btn btn-primary mt-4'
            //     ],
            //     'label' => 'reservez'

            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
            'chambre' => false
        ]);
    }
}
