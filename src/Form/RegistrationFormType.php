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
            ->add('email',EmailType::class,[
                "label"=>"Email <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "placeholder"=>"Email ",
                ]
            ])
            ->add('first_name',TextType::class,[
                "label"=>"Prénom <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "placeholder"=>"Prénom ",
                ]
            ])
            ->add('last_name',TextType::class,[
                "label"=>"Nom <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "placeholder"=>"Nom ",
                ]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                "label"=> " J 'ai lu et j 'accepte les conditions générales de vente.",
                'mapped' => false,
                "attr"=>[
                    "class"=>"checkbox"
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                "label"=>"Mot de passe <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    "placeholder"=>"Mot de passe",
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
