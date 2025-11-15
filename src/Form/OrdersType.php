<?php

namespace App\Form;

use App\Entity\Orders;
use App\Entity\Dishes;
use App\Entity\People;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
          $builder
            ->add('people', EntityType::class, [
                'class' => People::class,
                'choice_label' => 'name',
                'placeholder' => 'Выберите клиента',
                'label' => 'Клиент'
            ])
            ->add('dishes', EntityType::class, [
                'class' => Dishes::class,
                'choice_label' => 'dname',
                'label' => 'Блюда',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
