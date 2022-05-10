<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('datecom')
            ->add('prixtotale')
            ->add('valide')
            ->add('products', 'entity', array(
                'expanded' => true,
                'multiple' => true,
                'class' => 'App:Product',
                'property' => 'sites',
                'required'  => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
