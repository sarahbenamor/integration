<?php

namespace App\Form;

use App\Entity\Personnelle;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Import EntityType
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonnelleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('genre')
            ->add('genre', ChoiceType::class, [
                'label' => 'Genre',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('role', ChoiceType::class, [
                'label' => 'Role',
                'choices' => [
                    'Superviseur' => 'Superviseur',
                    'Chef' => 'Chef',
                    'Agent' => 'Agent',
                    'Contrôleur' => 'Contrôleur',
                ],
                'placeholder' => 'Choisissez un rôle',
                'required' => true,
            ])
            ->add('salaire')
            ->add('service', EntityType::class, [
                'class' => Service::class, 
                'choice_label' => 'type',  
                'placeholder' => 'Sélectionnez un service', 
                'required' => true, 
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnelle::class,
        ]);
    }
}
