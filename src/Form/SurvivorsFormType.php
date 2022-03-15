<?php

namespace App\Form;

use App\Entity\Survivors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurvivorsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('survivor_name')
            ->add('survivor_history')
            ->add('survivor_image')
            ->add('survivor_summary')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Survivors::class,
        ]);
    }
}
