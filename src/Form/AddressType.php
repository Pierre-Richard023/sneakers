<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name',TextType::class,[
                "label"=>"Prénom <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "class"=>" input ",
                    "placeholder"=>"Prénom ",
                ]
            ])
            ->add('last_name',TextType::class,[
                "label"=>"Nom <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "class"=>" input ",
                    "placeholder"=>"Nom ",
                ]
            ])
            ->add('company_name',TextType::class,[
                "label"=>"Société  ",
                "attr"=>[
                    "class"=>" input ",
                    "placeholder"=>"Société  ",
                ]
            ])
            ->add('address',TextType::class,[
                "label"=>"Adresse <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "class"=>" input ",
                    "placeholder"=>"Adresse ",
                ]
            ])
            ->add('additional_address',TextType::class,[
                "label"=>"Complément adresse ",
                "attr"=>[
                    "class"=>" input ",
                    "placeholder"=>"Complément adresse ",
                ]
            ])
            ->add('postal_code',TextType::class,[
                "label"=>"Code Postal <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "class"=>" input ",
                    "placeholder"=>"Code Postal ",
                ]
            ])
            ->add('city',TextType::class,[
                "label"=>"Ville <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "class"=>" input ",
                    "placeholder"=>"Ville ",
                ]
            ])
            ->add('country',ChoiceType::class,[
                "label"=>"Pays ",
                'choices' => [
                    'France' => 'France',
                    'Belgique' => 'Belgique',
                    "Guadeloupe" => "Guadeloupe",
                    "Guyane"=>"Guyane",
                    "Martinique" =>"Martinique",
                    "Mayotte" => "Mayotte",
                    "Réunion" =>"Réunion",
                    "Saint-Martin" => "Saint-Martin",
                    "Saint-Barthélemy" =>"Saint-Barthélemy"
                ],
            ])
            ->add('phone_number',TextType::class,[
                "label"=>"Tél Portable <span class=\"text-danger\">*</span> : ",
                "label_html"=>true,
                "attr"=>[
                    "class"=>" input ",
                    "placeholder"=>"Tél Portable ",
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
