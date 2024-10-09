<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ResetPasswordRequestFormType extends AbstractType
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
                'attr' => [
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary-normal focus:border-secondary-normal block w-full p-2.5",
                    'autocomplete' => 'email'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre email',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
