<?php

namespace App\Form;

use App\Entity\Restau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeR')
            ->add('nomR')
            ->add('adressR')
            ->add('paysR')
            ->add('telR')
            ->add('imgR',FileType::class,array('data_class' => null,'attr' => array(
                'class'=>'form-control border-color-6'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restau::class,
        ]);
    }
}
