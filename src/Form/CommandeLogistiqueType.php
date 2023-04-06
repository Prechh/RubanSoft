<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CommandeLogistiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('siret', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Siret :',
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

            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('postalCode', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Code postale :',
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

            ->add('state', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Etat production :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('weight', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Poids total :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('trackingNumber', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Numéros de suivie :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('dateStartDelivery', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Date départ livraison  :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('dateEndDelivery', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Date arrivée livraison  :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],

            ])

            ->add('stateDelivery', ChoiceType::class, [
                'choices' => [
                    'Pas encore livré' => 0,
                    'En cours de livraison' => 1,
                    'Livraison terminé' => 2
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Etat de la livraison :',
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
                'label' => 'S\'inscrire',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
