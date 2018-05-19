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
            //->add('auto_make', TextType::class)
            //->add('model', TextType::class)
            ->add('description', TextType::class)
            ->add('date', DateType::class)
            ->add('status', ChoiceType::class, array(
                'choices'  => array(
                    'Vykdomas' => "1",
                    'Uzbaigtas' => "2",
                    'Nutrauktas' => "0",
                ),
            ))
            ->add('submit', SubmitType::class)
            ->getForm();

    }
}