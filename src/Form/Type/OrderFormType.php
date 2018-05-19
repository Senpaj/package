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


class OrderFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('auto_make', ChoiceType::class, array(
                'choices'  => array(
                    'Acura' => "Acura",
                    'Aixam' => "Aixam",
                    'Alfa Romeo' => "Alfa Romeo",
                    'Alpina' => "Alpina",
                    'Aston Martin' => "Aston Martin",
                    'Audi' => "Audi",
                    'Bentley' => "Bentley",
                    'BMW' => "BMW",
                    'Buick' => "Buick",
                    'Cadillac' => "Cadillac",
                    'Chevrolet' => "Chevrolet",
                    'Chrysler' => "Chrysler",
                    'Citroen' => "Citroen",
                    'Dacia' => "Dacia",
                    'Daewoo' => "Daewoo",
                    'Dodge' => "Dodge",
                    'Ferrari' => "Ferrari",
                    'Fiat' => "Fiat",
                    'Ford' => "Ford",
                    'GAZ' => "GAZ",
                    'GMC' => "GMC",
                    'Honda' => "Honda",
                    'Hummer' => "Hummer",
                    'Hyundai' => "Hyundai",
                    'Infinity' => "Infinity",
                    'Isuzu' => "Isuzu",
                    'Iveco' => "Iveco",
                    'Jaguar' => "Jaguar",
                    'Jeep' => "Jeep",
                    'Kia' => "KIA",
                    'Lada' => "Lada",
                    'Lancia' => "Lancia",
                    'Land Rover' => "Land rover",
                    'Lexus' => "Lexus",
                    'Maserati' => "Maserati",
                    'Mazda' => "Mazda",
                    'Mercedes Benz' => "Mercedes-Benz",
                    'MG' => "MG",
                    'Microcar' => "Microcar",
                    'Mini' => "Mini",
                    'Mitsubishi' => "Mitsubishi",
                    'Moskvich' => "Moskvich",
                    'Nissan' => "Nissan",
                    'Opel' => "Opel",
                    'Peugeot' => "Peugeot",
                    'Plymouth' => "Plymouth",
                    'Pontiac' => "Pontiac",
                    'Porsche' => "Porsche",
                    'Renault' => "Renault",
                    'Rolls-Royce' => "Rolls-Royce",
                    'Rover' => "Rover",
                    'Saab' => "Saab",
                    'Scion' => "Scion",
                    'Seat' => "Seat",
                    'Skoda' => "Skoda",
                    'Smart' => "Smart",
                    'Subaru' => "Subaru",
                    'Suzuki' => "Suzuki",
                    'Tesla' => "Tesla",
                    'Toyota' => "Toyota",
                    'Volkswagen' => "Volkswagen",
                    'Volvo' => "Volvo",
                    ),
            ))
            ->add('model', TextType::class)
            ->add('description', TextType::class)
            ->add('date', DateType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

    }
}