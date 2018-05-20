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
<<<<<<< HEAD
        $builder->add('plainPasswordOld', PasswordType::class, array('label' => 'Current password'));
=======
        $builder->add('plainPasswordOld', PasswordType::class, array('label' => 'Senas slaptažodis'));
>>>>>>> 88f82deb51009d8847369930782aa7676db1342e
        $builder->add('plainPasswordNew', RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'Slaptažodžiai turi sutapti.',
            'required' => true,
            'first_options' => array('label' => 'Naujas slaptažodis'),
            'second_options' => array('label' => 'Pakartokite slaptažodį'),
        ));
        $builder->add('Submit', SubmitType::class, array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')));


    }


}
