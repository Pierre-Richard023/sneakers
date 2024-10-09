<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                "label" => "Email <span class=\"text-danger\">*</span> : ",
                "label_html" => true,
                "label_attr" => [
                    "class" => "block mb-2 text-sm font-medium text-gray-900 ",
                ],
                "attr" => [
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary-normal focus:border-secondary-normal block w-full p-2.5",
                    "placeholder" => "Email ",
                ]
            ])
            ->add('first_name', TextType::class, [
                "label" => "Prénom <span class=\"text-danger\">*</span> : ",
                "label_html" => true,
                "label_attr" => [
                    "class" => "block mb-2 text-sm font-medium text-gray-900 ",
                ],
                "attr" => [
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary-normal focus:border-secondary-normal block w-full p-2.5",
                    "placeholder" => "Prénom ",
                ]
            ])
            ->add('last_name', TextType::class, [
                "label" => "Nom <span class=\"text-danger\">*</span> : ",
                "label_html" => true,
                "label_attr" => [
                    "class" => "block mb-2 text-sm font-medium text-gray-900 ",
                ],
                "attr" => [
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary-normal focus:border-secondary-normal block w-full p-2.5",
                    "placeholder" => "Nom ",
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                "label" => " J'ai lu et j 'accepte les <a href='/' class='text-secondary-normal' target='_blank'> conditions générales de vente</a> .",
                "label_html" => true,
                "label_attr"=> [
                    "class"=>"font-light text-gray-500 ",
                ],
                'mapped' => false,
                "attr" => [
                    "class" => "w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-secondary-normal"
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                "label" => "Mot de passe <span class=\"text-danger\">*</span> : ",
                "label_html" => true,
                "label_attr" => [
                    "class" => "block mb-2 text-sm font-medium text-gray-900 ",
                ],
                'mapped' => false,
                'attr' => [
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary-normal focus:border-secondary-normal block w-full p-2.5",
                    'autocomplete' => 'new-password',
                    "placeholder" => "Mot de passe",
                ],
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
