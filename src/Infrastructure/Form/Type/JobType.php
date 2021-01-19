<?php

namespace App\Infrastructure\Form\Type;

use App\Domain\Enum\Job\StatusEnum;
use App\Domain\Model\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'title',
            TextType::class,
            [
                'required' => true,
            ]
        );
        $builder->add(
            'description',
            TextareaType::class,
            [
                'required' => true,
            ]
        );
        $builder->add(
            'status',
            ChoiceType::class,
            [
                'label' => 'Status',
                'required' => true,
                'choices' => array_flip(StatusEnum::ALL),
            ]
        );
        $builder->add(
            'workplace',
            TextType::class,
            [
                'required' => false,
            ]
        );
        $builder->add(
            'salary',
            MoneyType::class,
            [
                'required' => false,
                'currency' => 'USD'
            ]
        );

        $builder->add('Save', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-block btn-primary'
            ]
        ]);

        $builder->add('reset', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-block btn-outline-secondary'
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Job::class,
            ]
        );
    }
}