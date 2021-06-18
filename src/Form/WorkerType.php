<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Worker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class WorkerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Name can not be empty',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 100,
                        'minMessage' => 'Your name must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your name name cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('surname', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Surname can not be empty',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 100,
                        'minMessage' => 'Your surname must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your surname name cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('salary', NumberType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Salary can not be empty',
                    ]),
                    new GreaterThan([
                        'value' => 0,
                        'message' => 'Salary must be above 0 EUR',
                    ]),
                    new Type([
                        'type'=> 'numeric',
                        'message' => 'Salary must be number type'
                    ])
                ],
            ])
            ->add('street_name', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Street name can not be empty',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 100,
                        'minMessage' => 'Your street name must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your street name cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('house_no', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'House number can not be empty',
                    ]),
                ],
            ])
            ->add('zip_code', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Zip code can not be empty',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]{2}-[0-9]{3}$/',
                        'match' => true,
                        'message' => 'Your zip-code must be in XX-XXX pattern',
                    ])
                ],
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'City can not be empty',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 100,
                        'minMessage' => 'Your city name must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your city name cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('worker_type', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Worker type can not be empty',
                    ]),
                    new Choice([
                        'choices' => ['CEO', 'FOUNDER', 'MANAGER', 'REGULAR'],
                        'message' => 'You can choose only one of four possible values: CEO, FOUNDER, MANAGER, REGULAR',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Worker::class,
        ]);
    }
}
