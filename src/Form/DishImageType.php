<?php

namespace App\Form;

use App\Entity\DishImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class DishImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'Изображение',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Удалить изображение?',
                'download_label' => 'Скачать',
                'download_uri' => true,
                'image_uri' => true,
                'imagine_pattern' => 'thumb_small',
                'attr' => ['class' => 'form-control']
            ])
            ->add('sortOrder', IntegerType::class, [
                'label' => 'Порядок сортировки',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DishImage::class,
        ]);
    }
}