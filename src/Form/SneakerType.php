<?php

namespace App\Form;

use App\Entity\Brands;
use App\Entity\Models;
use App\Entity\Sneaker;
use App\Entity\SneakersImages;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SneakerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>"Nom",
                'attr' => [
                    'class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
                    'placeholder' => 'Nom',
                ],
            ])
            ->add('price',NumberType::class,[
                'label'=>"Prix",
                'attr' => [
                    'class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
                ],
            ])
            ->add('color',TextType::class,[
                'label'=>"Couleur",
                'attr' => [
                    'class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
                ],
            ])
            ->add('shoe_size',NumberType::class,[
                'label' => 'Pointures',
                'attr' => [
                    'class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
                ],
            ])
            ->add('stock',NumberType::class,[
                'label' => 'Quantité',
                'attr' => [
                    'class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
                ],
            ])
            ->add('release_date',DateType::class,[
                'label' => 'Date de sortie',
                'attr' => [
                    'class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5",
                ],
            ])
            ->add('details',CKEditorType::class,[
                'config' => array(
                    'uiColor' => '#ffffff',
                    //...
                ),
            ])
            ->add('model',EntityType::class,[
                'class'=>Models::class,
                'choice_label'=> 'name',
                'multiple'=> false,
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 '
                ],
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'attr' => [
                    'id'=>"image-upload",
                    'class' => "block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none",
                    'aria-describedby'=>"file_input_help",

                ],
            ])
            ->add('images',FileType::class,[
                'label' => 'Images',
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => "block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none",
                    'aria-describedby'=>"file_input_help",
                    'data-action'=>"change->sneakers#upload",
                    'data-sneakers-target'=>'input',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sneaker::class,
        ]);
    }
}
