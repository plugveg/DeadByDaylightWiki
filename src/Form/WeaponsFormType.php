<?php

/*Info sur le current directory*/
namespace App\Form;

/*Permet l'importation des différentes Entity*/
use App\Entity\Weapons;
/*Les use nécessaires pour lancer le code*/
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeaponsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('weapon_name')
            ->add('weapon_image')
            ->add('weapon_description')
            //->add('weapons_killer_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weapons::class,
        ]);
    }
}
