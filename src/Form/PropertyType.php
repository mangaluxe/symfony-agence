<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre'
            ])
            ->add('description')
            ->add('surface')
            ->add('rooms', null, [
                'label' => 'Pièces'
            ])
            ->add('bedrooms', null, [
                'label' => 'Chambres'
            ])
            ->add('floor', null, [
                'label' => 'Etage'
            ])
            ->add('price', null, [
                'label' => 'Prix'
            ])
            ->add('heat',
                ChoiceType::class, [
                    // 'choices' => Property::HEAT,
                    'choices' => $this->getChoices(),
                    'label' => 'Chauffage'
                ])
            ->add('city', null, [
                'label' => 'Ville'
            ])
            ->add('postal_code', null, [
                'label' => 'Code Postal'
            ])
            ->add('sold', null, [
                'label' => 'Vendu'
            ])
            // ->add('created_at')
            ->add('address', null, [
                'label' => 'Adresse'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
    
    private function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }







}
