<?php

namespace App\Form;

use App\Entity\Agency;
use App\Entity\Car;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model')
            ->add('brand')
            ->add('fuel')
            ->add('geerbox')
            ->add('kilometers')
            ->add('seats')
            ->add('registration')
            ->add('city', EntityType::class, [
                'class' => Agency::class,
                'choice_label' => 'city',
            ])
            ->add('Available');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
