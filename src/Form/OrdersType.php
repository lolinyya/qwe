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
            ->add('customer', EntityType::class, ['class' => \App\Entity\People::class, 'choice_label' => 'name'])
            ->add('dishes', EntityType::class, ['class' => \App\Entity\Dishes::class, 'choice_label' => 'name', 'multiple' => true, 'expanded' => true])
            ->add('documentFile', VichFileType::class, [
                'label' => 'Документ',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Удалить',
                'download_uri' => true,
                'constraints' => [new File([
                    'maxSize' => '10m',
                    'mimeTypes' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain', 'image/jpeg', 'image/png'],
                ])],
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
