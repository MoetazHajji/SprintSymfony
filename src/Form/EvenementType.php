<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_event')
            ->add('nbr_participant')
            ->add('date_debut')
            ->add('date_fin')
            ->add('emplacement')
            ->add('description')

            ->add('theme', ChoiceType::class, [
                'choices'  => [
                    'Gastronomie' => "Gastronomie",
                    'Cinéma' => "Cinéma",
                    'Industriel' => "Industriel",
                ],
            ])
            ->add('image', FileType::class, ['label' =>'image '])
        ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
