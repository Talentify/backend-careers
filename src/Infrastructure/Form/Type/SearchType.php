<?php

namespace App\Infrastructure\Form\Type;

use App\Domain\Enum\Job\StatusEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('get');
        $builder->add('status', ChoiceType::class, [
            'label' => 'Status',
            'choices' => array_flip(StatusEnum::ALL),
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}