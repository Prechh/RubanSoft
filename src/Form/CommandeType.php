<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommandeType extends AbstractType
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

            ->add('siret', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Numéros de siret :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])


            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prenom :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Email :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Numéros Téléphone :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])



            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse :',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('postalCode', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Code postal :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Ville :',
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
                'label' => 'Commander',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
