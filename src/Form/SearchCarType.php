<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Agency;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pickUpLocation', EntityType::class, [
                'required' => true,
                'label' => 'Pick-up location',
                'class' => Agency::class,
                'choice_label' => 'city',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('pickUpDate', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy/MM/dd',
                'years' => range(date('Y'), date('Y')+1),
                'label' => 'Pick-up date',
                'html5' => false,
                'attr' => [
                    'placeholder' => "2023/01/14"
                ]
            ])
            ->add('destination', TextType::class, [
                'required' => true,
                'label' => 'Destination',
                'attr' => [
                    'placeholder' => "Bordeaux"
                ]
            ])
            ->add('dropOffDate', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy/MM/dd',
                'years' => range(date('Y'), date('Y')+1),
                'label' => 'Drop-off date',
                'html5' => false,
                'attr' => [
                    'placeholder' => "2023/01/13"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
