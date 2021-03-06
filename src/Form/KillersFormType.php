<?php

/*Info sur le current directory*/
namespace App\Form;

/*Permet l'importation des différentes Entity*/
use App\Entity\Killers;
/*Les use nécessaires pour lancer le code*/
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KillersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('killer_nickname')
            ->add('killer_name')
            ->add('killer_image')
            ->add('killer_speed')
            ->add('killer_summary')
            ->add('killer_history')
            //->add('killer_map')
            //->add('killer_weapon')
            //->add('killer_power')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Killers::class,
        ]);
    }
}
