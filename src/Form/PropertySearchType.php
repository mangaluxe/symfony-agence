<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType; // Ajouté

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Modifié pour Filtre :
        $builder
            ->add('minPrice', IntegerType::class, [
                'required' => false,
                'label' => 'Budget min :',
                'attr' => [
                    'placeholder' => 'Budget min'
                ]
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => 'Budget max :',
                'attr' => [
                    'placeholder' => 'Budget max'
                ]
            ])
            ->add('minSurface', IntegerType::class, [
                'required' => false,
                'label' => 'Surface min :',
                'attr' => [
                    'placeholder' => 'Surface min'
                ]
            ])
            ->add('maxSurface', IntegerType::class, [
                'required' => false,
                'label' => 'Surface max :',
                'attr' => [
                    'placeholder' => 'Surface max'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // Modifié pour Filtre :
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    // Ajouté pour Filtre. Pour envoyer des données plus propre dans l'url avec GET
    public function getBlockPrefix()
    {
        return '';
    }







}
