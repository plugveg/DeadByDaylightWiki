<?php

namespace App\Form;

use App\Entity\Powers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PowersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('power_name')
            ->add('power_image')
            ->add('power_description')
            ->add('power_explanation')
            //->add('power_killer_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Powers::class,
        ]);
    }
}
