<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer un mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                            'max' => 4096,
                        ]),
                    ],
                    "label" => "Nouveau mot de passe <span class=\"text-danger\">*</span> : ",
                    "label_html" => true,
                    "label_attr" => [
                        "class" => "block mb-2 text-sm font-medium text-gray-900 ",
                    ],
                    "attr" => [
                        "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary-normal focus:border-secondary-normal block w-full p-2.5",
                        "placeholder" => "Nouveau mot de passe ",
                    ]
                ],
                'second_options' => [
                    "label" => "Répéter le mot de passe <span class=\"text-danger\">*</span> : ",
                    "label_html" => true,
                    "label_attr" => [
                        "class" => "block mb-2 text-sm font-medium text-gray-900 ",
                    ],
                    "attr" => [
                        "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary-normal focus:border-secondary-normal block w-full p-2.5",
                        "placeholder" => "Répéter le mot de passe ",
                    ]
                ],
                'invalid_message' => 'Les champs de mot de passe doivent correspondre.',
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
