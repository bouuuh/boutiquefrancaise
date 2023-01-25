<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('new_password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe doivent être identiques.',
            'label' => 'Votre Nouveau Mot de Passe',
            'required'=> true,
            'first_options' => [
                'label' => 'Votre nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Entrez votre nouveau mot de passe',
                    'class' => 'mt-2 mb-3'
            ]],
            'second_options' => [
                'label' => 'Confirmation de mot de passe',
                'attr' => [
                    'placeholder' => 'Confirmez votre mot de passe',
                    'class' => 'mt-2'
            ]]
        ])
        
        ->add('submit', SubmitType::class, [
            'label' => "Mettre à jour",
            'attr' => [
                'class' => 'btn btn-info col-12 mt-5'
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
