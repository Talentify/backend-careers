<?php

namespace App\Infra\Form;


use App\Domain\JobOpening\Entity\Embeddable\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', TextType::class, [
                'label' => 'Street',
                'required' => false,
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Postal Code',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'required' => false,
            ])
            ->add('country', TextType::class, [
                'label' => 'Country',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}