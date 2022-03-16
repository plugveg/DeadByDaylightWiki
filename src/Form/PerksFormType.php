<?php

/*Info sur le current directory*/
namespace App\Form;

/*Permet l'importation des différentes Entity*/
use App\Entity\Perks;
/*Les use nécessaires pour lancer le code*/
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerksFormType extends AbstractType
{
    /*Pour modifier une Perk déjà existante (sans la supprimer) */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('perk_name')
            ->add('perk_image')
            ->add('perk_explanation')
            //->add('perk_survivor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Perks::class,
        ]);
    }
}
