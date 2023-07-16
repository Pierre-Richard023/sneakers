<?php

namespace App\Form;

use App\Entity\Brands;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrandsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>"Nom de la marque",
                'attr' => [
                    'class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
                    'placeholder' => 'Nom de la marque',
                ],
            ])
            ->add('imageFile', FileType::class, [
                'required' => true,
                'attr' => [
                    'id'=>"image-upload",
                    'class' => "block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none",
                    'aria-describedby'=>"file_input_help",

                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brands::class,
        ]);
    }
}
