<?php

namespace App\Form;

use App\Entity\PerksKillers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerksKillersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('perkkiller_name')
            ->add('perkkiller_image')
            ->add('perkkiller_explanation')
            //->add('perk_killer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PerksKillers::class,
        ]);
    }
}
