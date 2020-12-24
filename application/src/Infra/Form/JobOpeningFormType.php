<?php


namespace App\Infra\Form;


use App\Domain\JobOpening\Entity\JobOpening;
use App\Infra\Request\JobOpeningRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOpeningFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
            ])
            ->add('status', TextType::class, [
                'label' => 'Status',
                'required' => true,
            ])
            ->add('workplace', AddressFormType::class, [
                'label' => 'Workplace',
                'required' => false,
            ])
            ->add('salary', MoneyFormType::class, [
                'label' => 'Salary',
                'required' => false,
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobOpeningRequest::class,
            'csrf_protection' => false
        ]);
    }
}