<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => "Nom de l'adresse",
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => "Entrez le nom de l'adresse"
                ]
            ])
            ->add('firstname', TextType::class,[
                'label' => 'Votre prénom',
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Votre nom',
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('company', TextType::class,[
                'label' => 'Votre entreprise',
                'required' => false,
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => '(facultatif) Entrez le nom de votre entreprise'
                ]
            ])
            ->add('address', TextType::class,[
                'label' => 'Votre adresse',
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => 'Entrez votre adresse'
                ]
            ])
            ->add('post', TextType::class,[
                'label' => 'Votre code postal',
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => 'Entrez votre code postal'
                ]
            ])
            ->add('city', TextType::class,[
                'label' => 'Votre ville',
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => 'Entrez votre ville'
                ]
            ])
            ->add('country', CountryType::class,[
                'label' => 'Votre pays',
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => 'Entrez votre pays'
                ]
            ])
            ->add('phone', TelType::class,[
                'label' => 'Votre numéro de téléphone',
                'attr' => [
                    'class' => 'mb-3',
                    'placeholder' => 'Entrez votre numéro de téléphone'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary col-12 mt-4',
                    
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
