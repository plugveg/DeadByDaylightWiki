<?php

/*Info sur le current directory*/
namespace App\Form;

/*Permet l'importation des différentes Entity*/
use App\Entity\Maps;
/*Les use nécessaires pour lancer le code*/
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MapsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('map_name')
            ->add('map_image')
            ->add('map_description')
            ->add('map_layout')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Maps::class,
        ]);
    }
}
