<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Votre Email'
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'Votre Prénom'
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => 'Votre Nom'
            ])
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mon mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Entrez votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'label' => 'Votre nouveau Mot de Passe',
                'required'=> true,
                'first_options' => [
                    'label' => 'Votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Entrez votre mot de passe'
                ]],
                'second_options' => [
                    'label' => 'Confirmation de votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmez votre nouveau mot de passe'
                ]]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Valider"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
