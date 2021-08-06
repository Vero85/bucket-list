<?php

namespace App\Form;

use App\Entity\Wish;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //il trouve par défaut le type de champ input

            ->add('title', null, [
                'label' => 'Votre titre :',
                'attr' => [
                    'placeholder' => 'Saisissez le titre de votre voeu !'
                ],
            ])
            ->add('description', null, [
                'label' => 'Votre description :',
                'attr' => [
                    'placeholder' => 'Saisissez la description de votre voeu !'
                ],
            ])
            ->add('author', null, [
                'label' => 'votre nom :',
                'attr' => [
                    'placeholder' => "Saisissez le nom de l'auteur"
                ],
            ])
            ->add('isPublished', null, [
                'label' => 'Date de publication',

            ])
            ->add('dateCreated', DateTimeType::class, [
                'label' => 'Date de création :',
                'widget' => 'single_text',

            ])
            /*
                    ->add('title')
                    ->add('description')
                    ->add('author')
                    ->add('isPublished')
                    ->add('dateCreated')
                    */;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
