<?php

namespace App\Form\Type;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('plainPasswordOld', PasswordType::class, array('label' => 'Senas slaptažodis'));
        $builder->add('plainPasswordNew', RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'Slaptažodžiai turi sutapti.',
            'required' => true,
            'first_options' => array('label' => 'Naujas slaptažodis'),
            'second_options' => array('label' => 'Pakartokite slaptažodį'),
        ));
        $builder->add('Submit', SubmitType::class);
    }


}
