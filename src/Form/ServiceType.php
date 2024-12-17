<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom')
            ->add('type')
            ->add('disponibilite', ChoiceType::class, [
                'label' => 'disponibilite',
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ]);  
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
