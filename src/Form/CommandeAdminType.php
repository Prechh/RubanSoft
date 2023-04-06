<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommandeAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('articles')

            ->add('quantity', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Quantitée :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])


            ->add('dateStartProd', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Date début de production :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('dateEndProd', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Date fin de production :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],

            ])

            ->add('state', ChoiceType::class, [
                'choices' => [
                    'Pas en prod' => 0,
                    'En cours de prod' => 1,
                    'Prod terminé' => 2
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Etat de la production :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('Submit', SubmitType::class, [
                'attr' => [
                    "class" => 'btn btn-success mt-5',
                ],
                'label' => 'Envoyer les modifications',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
