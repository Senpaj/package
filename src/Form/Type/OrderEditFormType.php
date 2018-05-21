<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
use App\Entity\CustomerOrder;


class OrderEditFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class, array('label' => 'Aprašymas'))
            ->add('date', DateType::class, array('label' => 'Data'))
            ->add('status', ChoiceType::class, array( 'label' => 'Būsena',
                'choices'  => array(
                    'Vykdomas' => "1",
                    'Baigtas' => "2",
                    'Nutrauktas' => "0",
                ),
            ))
            ->add('submit', SubmitType::class, array('label' => 'Atnaujinti'))
            ->getForm();

    }
}