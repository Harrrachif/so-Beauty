<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('prenom', TextType::class, [
            'label' => 'Votre prénom',
            'attr' => [
                'placeholder' => 'Saissisez votre prénom'
            ]
        ])
        ->add('nom', TextType::class, [
            'label' => 'Votre nom',
            'attr' => [
                'placeholder' => 'Saissisez votre nom'
            ]
        ])
        
        ->add('adresse', TextType::class, [
            'label' => 'Votre adresse?',
            'attr' => [
                'placeholder' => 'Saissisez votre adresse'
            ]
        ])
        ->add('postal', TextType::class, [
            'label' => 'Votre code postal',
            'attr' => [
                'placeholder' => 'Saissisez votre code postal'
            ]
        ])
        ->add('ville', TextType::class, [
            'label' => 'Ville',
            'attr' => [
                'placeholder' => 'Saissisez votre ville'
            ]
        ])
    
        ->add('telephone', TelType::class, [
            'label' => 'Votre téléphone ',
            'attr' => [
                'placeholder' => 'Saissisez votre téléphone'
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn-block btn-info'
            ]

        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
